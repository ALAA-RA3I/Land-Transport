@echo off
:loop
php C:\Users\ASUS\Desktop\Land-Transport\artisan schedule:run
timeout /t 60
goto loop