<div id="first" style="background:red;width:200px;height:200px">
	<a id="second" href="1.html" style="background:blue;padding:0 50 50 50">a link</a>
</div>
<div class="a" onclick="dian()"><a href='javascript:void(0)'>你好</a></div>
<script type='text/javascript'>
function dian()
{
  //点击触发动作在这里写...
   alert(1);
  //然后跳转
  location.href = '1.html';
}
</script>
<script type='text/javascript'>
	//捕获
	//document.getElementById('first').addEventListener('click',function(){alert(this.id)},true); 
	//document.getElementById('second').addEventListener('click',function(){alert(this.id)},true);
	//冒泡
	document.getElementById('first').addEventListener('click',function(){alert(this.id)},false);
	//document.getElementById('second').addEventListener('click',function(){alert(this.id)},false);
</script>
