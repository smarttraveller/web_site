<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<HTML>  
  <HEAD>  
  </HEAD>  
  <BODY>   
   
 <SCRIPT language = "vbscript">  
 'define application  
 dim v_prog  
   
 'set command  
 v_prog = "http://localhost/Research_Site/panorma/Adisham3.exe"  
   
 'create a shell  
 set v_shell = createobject("wscript.shell")  
  
        'run application   
 v_shell.run(v_prog)  
 </SCRIPT>  
      
 <SCRIPT language = "vbscript">  
  'set variables  
  dim v_shell  
  dim v_return  
  dim v_prog  
    
  'set command  
  v_prog = "%SystemRoot%\system32\ping 192.168.0.1"  
    
  'create a shell  
  set v_shell = CreateObject("WScript.Shell")  
    
  'run application  
  v_return = v_shell.Run(v_prog,1,TRUE)  
    
  'check return value  
  if v_return = 0 then  
   MsgBox "Server is up",64,"Server status"  
  else  
   MsgBox "Server is down",64,"Server status"  
  end if  
 </SCRIPT>  
   
  </BODY>  
</HTML>  
