@echo off
REM Start Docker container in detached mode
docker-compose up -d

REM Wait a few seconds for Laravel to start
timeout /t 5 /nobreak > nul

REM Open browser automatically
start http://127.0.0.1:8000

REM Follow container logs
docker-compose logs -f