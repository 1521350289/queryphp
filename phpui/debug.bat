@echo off

prompt -$g  
title QueryPHP PHP-GTK ��ʽ���ֹ��� 

if exist %PHPUI_PATH% (
        echo  PHPGTK δ��װ����PHPGTK_ROOT ��������δ����
        pause
        goto :eof
)
goto menu   
  
:menu   
echo ^ ��ӭʹ�� QueryPHP PHP-GTK ��ʽ���ֹ���   
echo ^--------------------------------------------   
echo ^ �����߿��԰������ʽ PHP-GTK ���������еĴ���
echo ^ ������ PHP ������ܾ��� www.queryphp.com (Query Yet Simple)
echo ^----------------------   
echo ^  1 ���ԣ�Ĭ�ϣ�  2 ִ��  0 �˳�   
echo ^----------------------   
set /p input=-^> ��ѡ��   
echo.   
if "%input%"== "0" goto end  
if "%input%"== "1" goto debug   
if "%input%"== "2" goto run 
if "%input%"== "" goto debug   
goto end  
  
:debug 
%PHPUI_PATH%\php-win.exe start.phpui
echo ^����Ϊ PHP-GTK ��ʽ����Ϣ   
echo ^----------------------   
echo ^  1 ���ԣ�Ĭ�ϣ�  2 ִ��  0 �˳�          
echo ^----------------------   
set /p input=-^>��ѡ�� :   
if "%input%"=="0" goto end  
if "%input%"=="1" goto debug   
if "%input%"=="2" goto run   
if "%input%"=="" goto debug   
goto end  

:run   
%PHPUI_PATH%\php.exe start.phpui
echo ^----------------------   
echo ^  1 ���ԣ�Ĭ�ϣ�  2 ִ��  0 �˳�          
echo ^----------------------   
set /p nSelect=-^>��ѡ�� :   
if "%input%"=="0" goto end  
if "%input%"=="1" goto debug   
if "%input%"=="2" goto run 
if "%input%"=="" goto debug   
goto end  
  
:end  
prompt   
popd