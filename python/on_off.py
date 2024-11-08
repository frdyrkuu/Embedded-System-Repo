import RPi.GPIO as GPIO
import sys

# GPIO pin setup
BUZZER_PIN = 22

# GPIO mode setup
GPIO.setmode(GPIO.BCM)
GPIO.setup(BUZZER_PIN, GPIO.OUT)

# Get the action from command line arguments
if len(sys.argv) != 2:
    print("Usage: on_off.py [on|off]")
    sys.exit(1)

action = sys.argv[1]

if action == 'on':
    GPIO.output(BUZZER_PIN, GPIO.HIGH)  # Turn on the buzzer
    print("Buzzer turned ON")
elif action == 'off':
    GPIO.output(BUZZER_PIN, GPIO.LOW)   # Turn off the buzzer
    print("Buzzer turned OFF")
else:
    print("Invalid action. Use 'on' or 'off'.")

GPIO.cleanup()
