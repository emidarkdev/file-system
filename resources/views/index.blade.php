<!DOCTYPE html PUBLIC "XHTML 1.0 Transitional" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
		<title>WorldSkills - FileClient</title>
		
		<link rel="stylesheet" href="{{asset('files/style.css')}}" type="text/css" media="screen">
	
		<style id="poshytip-css-tip-twitter" type="text/css">div.tip-twitter{visibility:hidden;position:absolute;top:0;left:0;}div.tip-twitter table, div.tip-twitter td{margin:0;font-family:inherit;font-size:inherit;font-weight:inherit;font-style:inherit;font-variant:inherit;}div.tip-twitter td.tip-bg-image span{display:block;font:1px/1px sans-serif;height:10px;width:10px;overflow:hidden;}div.tip-twitter td.tip-right{background-position:100% 0;}div.tip-twitter td.tip-bottom{background-position:100% 100%;}div.tip-twitter td.tip-left{background-position:0 100%;}div.tip-twitter div.tip-inner{background-position:-10px -10px;}div.tip-twitter div.tip-arrow{visibility:hidden;position:absolute;overflow:hidden;font:1px/1px sans-serif;}</style>
		<style id="poshytip-css-tip-yellowsimple" type="text/css">div.tip-yellowsimple{visibility:hidden;position:absolute;top:0;left:0;}div.tip-yellowsimple table, div.tip-yellowsimple td{margin:0;font-family:inherit;font-size:inherit;font-weight:inherit;font-style:inherit;font-variant:inherit;}div.tip-yellowsimple td.tip-bg-image span{display:block;font:1px/1px sans-serif;height:10px;width:10px;overflow:hidden;}div.tip-yellowsimple td.tip-right{background-position:100% 0;}div.tip-yellowsimple td.tip-bottom{background-position:100% 100%;}div.tip-yellowsimple td.tip-left{background-position:0 100%;}div.tip-yellowsimple div.tip-inner{background-position:-10px -10px;}div.tip-yellowsimple div.tip-arrow{visibility:hidden;position:absolute;overflow:hidden;font:1px/1px sans-serif;}</style>
	</head>
	<body onload="">
		<!-- WRAPPER -->
		<div id="wrapper">
			<!-- HEADER -->
			<div id="header" style="height: 180px;">
				
				<img id="logo" src="./files/logo.png" width="150">
			</div>
			<!-- ENDS HEADER -->
			<!-- MAIN -->
			<div id="main">
				<!-- content -->
				<div id="content">
					<!-- title -->
					<div id="page-title">
						<span class="title">مدیریت فایل</span>
						<div style="text-align: right; margin-top: 10px;">
						</div>
					</div>
					<!-- ENDS title -->
					<form name="BrowseForm" id="BrowseForm" action="" method="post">
						<table id="toptable">
							<tbody>
								<tr valign="bottom">
									<td rowspan="2" width="40">&nbsp;  </td>
									<td style="text-align: left;">
										<input type="text" name="directory" value="/public_html" style="width: 400px;" title="(accesskey g)" accesskey="g"> 
										<a href="javascript:createDirectoryTreeWindow('/public_html','BrowseForm.directory');" title="List"><img src="./files/view_tree.png" alt="List" onmouseover="this.style.margin=&#39;0px&#39;;this.style.width=&#39;34px&#39;;this.style.height=&#39;34px&#39;;" onmouseout="this.style.margin=&#39;1px&#39;;this.style.width=&#39;32px&#39;;this.style.height=&#39;32px&#39;;" style="border: 0px; margin: 1px; width: 32px; height: 32px; vertical-align: middle;"></a>
										<br>
										<span style="font-size: 80%;"> <a href="javascript:submitBrowseForm('/','','browse','main');">شاخه اصلی</a> /public_html</span>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<table id="maintable" style="width: 925px;">
							<tbody>
								<tr class="browse_rows_actions">
									<td colspan="6">
										<table style="width: 925px;">
											<tbody>
												<tr>
													<td valign="top" style="text-align: left;">
														<input type="button" id="smallbutton" value="پوشه جدید" title="Make a new subdirectory in directory /public_html (accesskey w)" accesskey="w">
														<input type="button" id="smallbutton" value="فایل جدید" title="Create a new file in directory /public_html (accesskey y)" accesskey="y">
														<input type="button" id="smallbutton" value="آپلود" title="Upload new files in directory /public_html (accesskey u)" accesskey="u">
                                                        <input type="button" id="smallbutton" value="انتقال" title="Move the selected entries (accesskey m)" accesskey="m">
														<input type="button" id="smallbutton" value="حذف" title="Delete the selected entries (accesskey d)" accesskey="d">
														
													</td>
													<td valign="top" style="text-align: right;">
												
														
													
														<div style="margin-top: 3px;">
															<input type="button" id="smallbutton" value="دانلود"  title="Download a zip file containing all selected entries (accesskey x)" accesskey="x">
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								
							</tbody>
						</table>
				
					<ul id="items">
                    	<li>
                        	<div class="item-title">
								<input type="checkbox" /> عنوان فایل
                          </div>
                            <div class="item-prob">
                             file.jpg , 12kb , Last Modify : 12 Jun 2017
                            </div>
                          <div class="items-meta">
                            	<a href="#">حذف</a> -
                                <a href="#">ویرایش</a> -
                                <a href="#">نمایش</a> -
                                <a href="#">انتقال</a> -
                                 <a href="#">تغییر نام</a> 
                          </div>
                        </li>
                        <li>
                        	<div class="item-title">
								<input type="checkbox" />  <img src="files/folder.png" /> عنوان فولدر
                          </div>
                            <div class="items-meta">
                            	<a href="#">حذف</a> -
                                <a href="#">انتقال</a> -
                                 <a href="#">تغییر نام</a> 
                          </div>
                        </li>

                    </ul>
                    </form>
			  </div>
				<!-- ENDS content -->
			</div>
			<!-- ENDS MAIN -->
			<!-- FOOTER -->
			<div id="footer">
				<!-- Bottom -->
				<div id="bottom">
					18th Iran WorldSkills Competition
				</div>
				<!-- ENDS Bottom -->
			</div>
			<!-- ENDS FOOTER -->
		</div>
		<!-- ENDS WRAPPER -->
	
	</body>
</html>