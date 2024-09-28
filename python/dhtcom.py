import time
import os
import board
import adafruit_dht
import mysql.connector
from mysql.connector import Error
import smtplib
from email.mime.text import MIMEText
import RPi.GPIO as GPIO

# GPIO setup
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

# Define GPIO pins
PIR_PIN = 27  # GPIO27 for PIR sensor
BUZZER_PIN = 17  # GPIO17 for Buzzer
DHT_PIN = board.D4  # GPIO pin for DHT22

GPIO.setup(PIR_PIN, GPIO.IN)
GPIO.setup(BUZZER_PIN, GPIO.OUT)
GPIO.output(BUZZER_PIN, GPIO.LOW)  # Initially turn off the buzzer

# Email configuration
EMAIL_ADDRESS = 'akamekill253@gmail.com'  # Replace with your email address
EMAIL_PASSWORD = 'akdr mleh qyfm qpcp'  # Replace with your generated app password

# MySQL database connection details
db_config = {
    'host': 'localhost',
    'database': 'DHT22',
    'user': 'admin',  # Replace with your MySQL username
    'password': 'password'  # Replace with your MySQL password
}

# Ensure the output directory exists
output_directory = "/var/www/html/python/image"
os.makedirs(output_directory, exist_ok=True)

# Create a DHT22 sensor object
dht_device = adafruit_dht.DHT22(DHT_PIN, use_pulseio=False)

def connect_to_db():
    """Connect to the MySQL database."""
    try:
        connection = mysql.connector.connect(**db_config)
        if connection.is_connected():
            print("Successfully connected to the database")
            return connection
    except Error as e:
        print(f"Error while connecting to MySQL: {e}")
    return None

def insert_motion_data(movement):
    """Insert motion detection data into the database."""
    connection = connect_to_db()
    if connection is None:
        return

    try:
        cursor = connection.cursor()
        query = "INSERT INTO pir_motion (movement) VALUES (%s)"
        cursor.execute(query, (movement,))
        connection.commit()
        print("Motion data inserted successfully")
    except Error as e:
        print(f"Error while inserting motion data: {e}")
    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def insert_data(temperature, humidity):
    """Insert temperature and humidity data into the database."""
    connection = connect_to_db()
    if connection is None:
        return

    try:
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

def insert_image(image_path):
    """Insert image path into the database."""
    connection = connect_to_db()
    if connection is None:
        return

    try:
        cursor = connection.cursor()
        query = "INSERT INTO images (image_path) VALUES (%s)"
        cursor.execute(query, (image_path,))
        connection.commit()
        print("Image path inserted successfully")
    except Error as e:
        print(f"Error while inserting image path: {e}")
    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def send_email_alert():
    """Send an email alert."""
    subject = "Motion Detected!"
    body = "Alert: Motion has been detected by the PIR sensor."
    
    msg = MIMEText(body)
    msg['Subject'] = subject
    msg['From'] = EMAIL_ADDRESS
    msg['To'] = EMAIL_ADDRESS  # Send to your own email

    try:
        with smtplib.SMTP('smtp.gmail.com', 587) as server:
            server.starttls()
            server.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
            server.send_message(msg)
            print("Email alert sent!")
    except Exception as e:
        print(f"Failed to send email: {e}")

def activate_buzzer(activate):
    """Activate or deactivate the buzzer."""
    GPIO.output(BUZZER_PIN, GPIO.HIGH if activate else GPIO.LOW)

def read_dht22():
    """Read temperature and humidity from the DHT22 sensor."""
    try:
        temperature_c = dht_device.temperature
        humidity = dht_device.humidity

        if temperature_c is not None and humidity is not None:
            print(f"Temperature: {temperature_c:.1f} C")
            print(f"Humidity: {humidity:.1f}%")
            insert_data(temperature_c, humidity)

            # Activate buzzer if temperature exceeds 38°C
            activate_buzzer(temperature_c >= 38)
        else:
            print("Failed to retrieve data from sensor")

    except RuntimeError as error:
        print(f"RuntimeError: {error}")

    except Exception as error:
        print(f"Exception: {error}")

# Start the PIR sensor test
try:
    print("PIR Module Test (CTRL+C to exit)")
    time.sleep(2)

    while True:
        pir_value = GPIO.input(PIR_PIN)
        print(f"PIR Sensor Value: {pir_value}")

        if pir_value:
            print("Motion Detected!")
            insert_motion_data(1.0)  # Log motion detection as 1.0
            send_email_alert()  # Send email alert
            GPIO.output(BUZZER_PIN, GPIO.HIGH)
            time.sleep(1)
            GPIO.output(BUZZER_PIN, GPIO.LOW)

            # Capture a screenshot from the camera (you can use a placeholder if no camera)
            image_path = f"{output_directory}/motion_capture.jpg"
            # Here you should capture the image if using a camera
            # cv2.imwrite(image_path, frame)  # Uncomment if capturing from a camera
            print(f"Image captured: {image_path}")

            # Insert the image path into the database
            insert_image(image_path)

            # Increase the delay to prevent rapid triggering
            time.sleep(10)  # Delay for 10 seconds before the next detection
        else:
            insert_motion_data(0.0)  # Log no motion detection as 0.0

        # Read DHT22 data every loop
        read_dht22()

except KeyboardInterrupt:
    print("Exiting...")

finally:
    GPIO.cleanup()
