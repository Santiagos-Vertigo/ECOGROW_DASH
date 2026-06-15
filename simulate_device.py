import requests
import random
import time
from datetime import datetime

API_URL = "http://ecogrowcontrol.com/api/telemetry"
API_KEY = "abc123"

while True:
    payload = {
        "soil_moisture": random.randint(30, 80),
        "timestamp": datetime.utcnow().isoformat()
    }

    headers = {
        "Content-Type": "application/json",
        "x-api-key": API_KEY
    }

    response = requests.post(API_URL, json=payload, headers=headers)

    print("Sent:", payload, "Response:", response.text)

    time.sleep(5)
