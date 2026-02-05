# Auto Push Script for Flexi Plugin

git status

git add .

$time = Get-Date -Format "yyyy-MM-dd HH:mm"

git commit -m "Auto update $time"

git push origin main

pause
