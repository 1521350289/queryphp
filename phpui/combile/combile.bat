@echo off

if not exist %PHPUI_PATH% (
        echo  PHPUI_PATH ��������δ����
        pause
        goto :eof
)

if "%b2eprogramfilename%"==""  (
	echo ��Ҫ�鿴�����ʹ�� BatToExeConverter ������
	pause
	goto :eof
)

php.exe start.phpui