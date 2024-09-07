import time
import mysql.connector
from mysql.connector import Error
import RPi.GPIO as GPIO

# Define the pins for the ultrasonic sensor
trig_pin = 23  # GPIO pin for the ultrasonic sensor trigger
echo_pin = 24  # GPIO pin for the ultrasonic sensor echo

# Define the pin for the buzzer (if you want to keep buzzer functionality)
buzzer_pin = 17  # GPIO pin for the buzzer

# Set up GPIO
GPIO.setwarnings(False)  # Suppress warnings
GPIO.setmode(GPIO.BCM)
GPIO.setup(trig_pin, GPIO.OUT)
GPIO.setup(echo_pin, GPIO.IN)
GPIO.setup(buzzer_pin, GPIO.OUT)
GPIO.output(buzzer_pin, GPIO.LOW)  # Initially turn off the buzzer

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

def insert_ultrasonic_data(distance):
    try:
        connection = connect_to_db()
        if connection is None:
            return

        cursor = connection.cursor()
        query = "INSERT INTO ultrasonic (distance) VALUES (%s)"
        values = (distance,)
        cursor.execute(query, values)
        connection.commit()
        print("Ultrasonic data inserted successfully")

    except Error as e:
        print(f"Error while inserting ultrasonic data: {e}")

    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def activate_buzzer(activate):
    if activate:
        GPIO.output(buzzer_pin, GPIO.HIGH)  # Turn on the buzzer
    else:
        GPIO.output(buzzer_pin, GPIO.LOW)  # Turn off the buzzer

def read_ultrasonic():
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
        
        print(f"Distance: {distance:.2f} cm")

        # Insert data into the database
        insert_ultrasonic_data(distance)

        # Activate buzzer if distance is less than 10 cm (or any other threshold you choose)
        if distance > 12:
            activate_buzzer(True)
        else:
            activate_buzzer(False)

    except Exception as error:
        print(f"Exception: {error}")

def main():
    try:
        while True:
            read_ultrasonic()
            time.sleep(2)  # Wait for 2 seconds before the next read
    finally:
        GPIO.cleanup()  # Clean up GPIO on exit

if __name__ == "__main__":
    main()