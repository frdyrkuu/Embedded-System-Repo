import RPi.GPIO as GPIO
import time
import os  # For executing shell commands

# Suppress warnings
GPIO.setwarnings(False)

# GPIO setup
GPIO.setmode(GPIO.BCM)
PIR_PIN = 27  # GPIO27 for PIR sensor
BUZZER_PIN = 17  # GPIO17 for Buzzer
GPIO.setup(PIR_PIN, GPIO.IN)  # PIR motion sensor input
GPIO.setup(BUZZER_PIN, GPIO.OUT)  # Buzzer output

# Ensure the output directory exists
output_directory = "/var/www/html/python/image"
os.makedirs(output_directory, exist_ok=True)

try:
    print("PIR Module Test (CTRL+C to exit)")
    time.sleep(2)  # Allow the PIR sensor to initialize

    while True:
        pir_value = GPIO.input(PIR_PIN)  # Get the input value from the PIR sensor
        print(f"PIR Sensor Value: {pir_value}")  # Print the PIR sensor value
        
        if pir_value:  # If motion is detected
            print("Motion Detected!")
            GPIO.output(BUZZER_PIN, GPIO.HIGH)  # Turn on the buzzer
            time.sleep(1)  # Buzzer on for 1 second
            GPIO.output(BUZZER_PIN, GPIO.LOW)  # Turn off the buzzer
            
            # Capture an image using fswebcam with a timestamp
            timestamp = time.strftime("%Y%m%d-%H%M%S")
            result = os.system(f"fswebcam -r 640x480 --no-banner {output_directory}/motion_capture_{timestamp}.jpg")
            
            if result == 0:
                print("Image captured!")
            else:
                print("Failed to capture image.")

        time.sleep(0.1)  # Small delay to avoid excessive CPU usage

except KeyboardInterrupt:
    print("Exiting...")

finally:
    GPIO.cleanup()  # Clean up GPIO on exit
