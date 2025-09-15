@echo off
cd /d C:\laragon\www\rbteknik
start php spark serve

timeout /t 3 >nul
cd /d C:\Users\iqbal\OneDrive\Desktop
start ngrok http 8080
