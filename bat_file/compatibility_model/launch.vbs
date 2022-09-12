Set WshShell = CreateObject("WScript.Shell")
WshShell.Run chr(34) & "C:\xampp\htdocs\training\hikari\bat_file\compatibility_model\gas_b450.bat" & Chr(34), 0
WshShell.Run chr(34) & "C:\xampp\htdocs\training\hikari\bat_file\compatibility_model\gas_b440.bat" & Chr(34), 0
WshShell.Run chr(34) & "C:\xampp\htdocs\training\hikari\bat_file\compatibility_model\gas_u200.bat" & Chr(34), 0
WshShell.Run chr(34) & "C:\xampp\htdocs\training\hikari\bat_file\compatibility_model\gas_duplicate.bat" & Chr(34), 0
Set WshShell = Nothing
