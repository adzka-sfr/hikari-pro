Set WshShell = CreateObject("WScript.Shell")
WshShell.Run chr(34) & "C:\xampp\htdocs\hikari\bat_file\production_result\gas_result.bat" & Chr(34), 0
Set WshShell = Nothing
