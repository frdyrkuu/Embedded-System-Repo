import time
import board
import adafruit_dht
import mysql.connector
from mysql.connector import Error
import RPi.GPIO as GPIO

# Define GPIO pins for ultrasonic sensors and DHT22
trig_pins = [23, 25]  # GPIO pins for the ultrasonic sensors' triggers
echo_pins = [24, 26]  # GPIO pins for the ultrasonic sensors' echos
dht_pin = board.D4    # GPIO pin for DHT22 sensor
buzzer_pin = 17       # GPIO pin for the buzzer

# Set up GPIO
GPIO.setwarnings(False)  # Suppress warnings
GPIO.setmode(GPIO.BCM)
for pin in trig_pins + echo_pins:
    GPIO.setup(pin, GPIO.OUT if pin in trig_pins else GPIO.IN)
GPIO.setup(buzzer_pin, GPIO.OUT)
GPIO.output(buzzer_pin, GPIO.LOW)  # Initially turn off the buzzer

# Create a DHT22 sensor object
dht_device = adafruit_dht.DHT22(dht_pin, use_pulseio=False)

# MySQL database connection details
db_config = {
    'host': 'localhost',
    'database': 'DHT22',
    'user': 'admin',    # Replace with your MySQL username
    'password': 'password'  # Replace with your MySQL password
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

def insert_ultrasonic_data(distance, distance1):
    try:
        connection = connect_to_db()
        if connection is None:
            return

        cursor = connection.cursor()
        query = "INSERT INTO ultrasonic (distance, distance1) VALUES (%s, %s)"
        values = (distance, distance1)
        cursor.execute(query, values)
        connection.commit()
        print("Ultrasonic data inserted successfully")

    except Error as e:
        print(f"Error while inserting ultrasonic data: {e}")

    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def insert_dht_data(temperature, humidity):
    try:
        connection = connect_to_db()
        if connection is None:
            return

        cursor = connection.cursor()
        query = "INSERT INTO dht22_values (temperature, humidity) VALUES (%s, %s)"
        values = (temperature, humidity)
        cursor.execute(query, values)
        connection.commit()
        print("DHT22 data inserted successfully")

    except Error as e:
        print(f"Error while inserting DHT22 data: {e}")

    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def activate_buzzer(activate):
    GPIO.output(buzzer_pin, GPIO.HIGH if activate else GPIO.LOW)  # Control buzzer

def read_ultrasonic(trig_pin, echo_pin):
    try:
        # Send a pulse to the TRIG pin
        GPIO.output(trig_pin, True)
        time.sleep(0.00001)  # 10 microseconds
        GPIO.output(trig_pin, False)

        # Wait for the ECHO pin to go high
        while GPIO.input(echo_pin) == 0:
            pulse_start = time.time()

        # Wait for the ECHO pin to go low
        while GPIO.input(echo_pin) == 1:
            pulse_end = time.time()

        # Calculate pulse duration
        pulse_duration = pulse_end - pulse_start

        # Calculate distance (Speed of sound is 34300 cm/s)
        distance = pulse_duration * 17150
        
        return distance

    except Exception as error:
        print(f"Exception: {error}")
        return None

def read_dht22():
    try:
        # Read temperature and humidity from the sensor
        temperature_c = dht_device.temperature
        humidity = dht_device.humidity

        if temperature_c is not None and humidity is not None:
            print(f"Temperature: {temperature_c:.1f} C")
            print(f"Humidity: {humidity:.1f}%")
            
            # Insert data into the database
            insert_dht_data(temperature_c, humidity)
            
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
            # Read distances from both ultrasonic sensors
            distance = read_ultrasonic(trig_pins[0], echo_pins[0])
            distance1 = read_ultrasonic(trig_pins[1], echo_pins[1])

            if distance is not None and distance1 is not None:
                print(f"Distance 1: {distance:.2f} cm, Distance 2: {distance1:.2f} cm")
                
                # Insert data into the database
                insert_ultrasonic_data(distance, distance1)

                # Activate buzzer based on distance thresholds
                activate_buzzer(distance >= 12 or distance1 >= 12)

            # Read and process DHT22 data
            read_dht22()

            time.sleep(2)  # Wait for 2 seconds before the next read

    finally:
        GPIO.cleanup()  # Clean up GPIO on exit

if __name__ == "__main__":
    main()
