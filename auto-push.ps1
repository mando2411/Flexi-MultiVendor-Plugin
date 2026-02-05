cd "D:\أسواق تاج\Flexi MultiVendor V1.0\Flexi-MultiVendor-Plugin"

git add .

$time = Get-Date -Format "yyyy-MM-dd HH:mm"

git commit -m "Auto update $time"

git push origin main

pause
