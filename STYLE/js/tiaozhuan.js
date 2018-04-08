　　var time = 8; //时间,秒
　　　　　　　　function Redirect() {
 　　　　　　　　window.location = "http://www.grn365.com/";
　　　　　　　　}
　　　　　　　　var i = 0;
　　　　　　　　function dis() {
 　　　　　　　　document.all.s.innerHTML = "还剩" + (time - i) + "秒";
 　　　　　　　　i++;
　　　　　　　　}

　　　　　　　　timer = setInterval('dis()', 1000); //显示时间
　　　　　　　　timer = setTimeout('Redirect()', time * 1000); //跳转