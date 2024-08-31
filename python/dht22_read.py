import time
import board
import adafruit_dht
import mysql.connector
from mysql.connector import Error
import digitalio
import RPi.GPIO as GPIO

# Define the pin where the DHT22 is connected
dht_pin = board.D4  # Change to the GPIO pin you are using

# Define the pin where the buzzer is connected
buzzer_pin = 17  # Change to the GPIO pin you are using for the buzzer

# Set up the buzzer pin
GPIO.setmode(GPIO.BCM)
GPIO.setup(buzzer_pin, GPIO.OUT)
GPIO.output(buzzer_pin, GPIO.LOW)  # Initially turn off the buzzer

# Create a DHT22 sensor object
dht_device = adafruit_dht.DHT22(dht_pin, use_pulseio=False)

# MySQL database connection details
db_config = {
    'host': 'localhost',
    'database': 'DHT22',
    'user': 'admin',    # Replace with your MySQL username
    'password': 'password' # Replace with your MySQL password
}

def connect_to_db():
    try:
        connection = mysql.connector.connect(**db_config)
        if connection.is_connected():
            print("Successfully connected to the database")
            return connection
    except Error as e:
        print(f"Error while connecting to MySQL: {e}")
        return None

def insert_data(temperature, humidity):
    try:
        connection = connect_to_db()
        if connection is None:
            return

        cursor = connection.cursor()
        query = "INSERT INTO dht22_values (temperature, humidity) VALUES (%s, %s)"
        values = (temperature, humidity)
        cursor.execute(query, values)
        connection.commit()
        print("Data inserted successfully")

    except Error as e:
        print(f"Error while inserting data: {e}")

    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def activate_buzzer(activate):
    if activate:
        GPIO.output(buzzer_pin, GPIO.HIGH)  # Turn on the buzzer
    else:
        GPIO.output(buzzer_pin, GPIO.LOW)  # Turn off the buzzer

def read_dht22():
    try:
        # Read temperature and humidity from the sensor
        temperature_c = dht_device.temperature
        humidity = dht_device.humidity

        if temperature_c is not None and humidity is not None:
            print(f"Temperature: {temperature_c:.1f} C")
            print(f"Humidity: {humidity:.1f}%")
            
            # Insert data into the database
            insert_data(temperature_c, humidity)
            
            # Activate buzzer if temperature exceeds 38°C
            if temperature_c >= 38:
                activate_buzzer(True)
            else:
                activate_buzzer(False)
        else:
            print("Failed to retrieve data from sensor")

    except RuntimeError as error:
        # Handle sensor read errors
        print(f"RuntimeError: {error}")

    except Exception as error:
        # Handle other possible errors
        print(f"Exception: {error}")

def main():
    try:
        while True:
            read_dht22()
            time.sleep(2)  # Wait for 2 seconds before the next read
    finally:
        GPIO.cleanup()  # Clean up GPIO on exit

if __name__ == "__main__":
    main()