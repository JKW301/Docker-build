FROM python:3.9-slim

RUN apt-get update && apt-get install -y python3-tk 

RUN rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY requirements.txt .

RUN pip install --upgrade pip

RUN pip install -r requirements.txt

COPY atdticket.py .

CMD ["python", "./atdticket.py"]