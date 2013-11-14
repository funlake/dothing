<div class="well">
	<form class="form-horizontal" id="Afm" method="post" action="http://localhost:81/dothing/demo/index.php/debug/index/clearsession">
		<div class="col-lg-5"></div>
		<div class="col-lg-4"></div>
		<div class="col-lg-3">
						<button class="btn btn-danger" id="clear_seesion">
				<i class="glyphicon glyphicon-remove glyphicon-white"></i> Clear and back			</button>
					</div>
		<input type="hidden" value="http://localhost:81/dothing/demo/index.php/ads007/user/permission" name="source_link"/>
		<input type="hidden" value="admin/user/permission" name="mca"/>
	</form>
<table class="table table-bordered table-striped">
	<thead></thead>
	<tbody>
		<tr class="info">
		<td width='10%'>Error msg</td>
		<td>SELECT
SQL_CALC_FOUND_ROWS *
FROM `module` 

WHERE  iname like ?


Limit 0  , 20<br/><font color=red>Unknown column 'iname' in 'where clause'</font>
		</td>
	</tr>
	<tr>
		<td>Traces</td>
		<td>
							<table calss="table table-bordered table-striped">
				<tr>
					<th width='30%'>File</th>
					<th width='5%'>Line</th>
					<th>Function</th>
				</tr>
				<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/database/database.php</td>
						<td>154</td>
						<td>&nbsp;</td>
				</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/database/database.php</td>
						<td>208</td>
						<td>Query</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/database/database.php</td>
						<td>236</td>
						<td>GetAll</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/database/table.php</td>
						<td>75</td>
						<td>GetCol</td>
					</tr>
									<tr>
						<td>^</td>
						<td>-</td>
						<td>GetCol</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/database/table.php</td>
						<td>84</td>
						<td>call_user_func_array</td>
					</tr>
									<tr>
						<td>^</td>
						<td>-</td>
						<td>GetAll</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/Model.php</td>
						<td>172</td>
						<td>call_user_func_array</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/Model.php</td>
						<td>126</td>
						<td>Select</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/demo/models/module.php</td>
						<td>31</td>
						<td>Find</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/demo/views/modules/admin/user/permission.php</td>
						<td>28</td>
						<td>Find</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/View.php</td>
						<td>45</td>
						<td>include</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/Controller.php</td>
						<td>242</td>
						<td>Display</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/demo/modules/admin/user.php</td>
						<td>115</td>
						<td>Display</td>
					</tr>
									<tr>
						<td>^</td>
						<td>-</td>
						<td>permissionAction</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/lib/Router.php</td>
						<td>54</td>
						<td>call_user_func</td>
					</tr>
									<tr>
						<td>/Applications/MAMP/htdocs/dothing/demo/index.php</td>
						<td>19</td>
						<td>Dispatch</td>
					</tr>
								</table>
					</td>
	</tr>
		</tbody>
</table>
</div>