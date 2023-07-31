<!DOCTYPE html PUBLIC "XHTML 1.0 Transitional" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <title>WorldSkills - FileClient</title>

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}" type="text/css" media="screen">

    <style id="poshytip-css-tip-twitter" type="text/css">
        div.tip-twitter {
            visibility: hidden;
            position: absolute;
            top: 0;
            left: 0;
        }

        div.tip-twitter table,
        div.tip-twitter td {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit;
            font-style: inherit;
            font-variant: inherit;
        }

        div.tip-twitter td.tip-bg-image span {
            display: block;
            font: 1px/1px sans-serif;
            height: 10px;
            width: 10px;
            overflow: hidden;
        }

        div.tip-twitter td.tip-right {
            background-position: 100% 0;
        }

        div.tip-twitter td.tip-bottom {
            background-position: 100% 100%;
        }

        div.tip-twitter td.tip-left {
            background-position: 0 100%;
        }

        div.tip-twitter div.tip-inner {
            background-position: -10px -10px;
        }

        div.tip-twitter div.tip-arrow {
            visibility: hidden;
            position: absolute;
            overflow: hidden;
            font: 1px/1px sans-serif;
        }
    </style>
    <style id="poshytip-css-tip-yellowsimple" type="text/css">
        div.tip-yellowsimple {
            visibility: hidden;
            position: absolute;
            top: 0;
            left: 0;
        }

        div.tip-yellowsimple table,
        div.tip-yellowsimple td {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit;
            font-style: inherit;
            font-variant: inherit;
        }

        div.tip-yellowsimple td.tip-bg-image span {
            display: block;
            font: 1px/1px sans-serif;
            height: 10px;
            width: 10px;
            overflow: hidden;
        }

        div.tip-yellowsimple td.tip-right {
            background-position: 100% 0;
        }

        div.tip-yellowsimple td.tip-bottom {
            background-position: 100% 100%;
        }

        div.tip-yellowsimple td.tip-left {
            background-position: 0 100%;
        }

        div.tip-yellowsimple div.tip-inner {
            background-position: -10px -10px;
        }

        div.tip-yellowsimple div.tip-arrow {
            visibility: hidden;
            position: absolute;
            overflow: hidden;
            font: 1px/1px sans-serif;
        }
    </style>
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
                <table id="toptable">
                    <tbody>
                        <tr valign="bottom">
                            <td rowspan="2" width="40">&nbsp; </td>
                            <td style="text-align: left;">
                                <form action="{{url('directory')}}" method="get">
                                    <input type="text" name="route" value="{{$route}}" placeholder="example : file/images" style="width: 400px;">
                                    <button type="submit" title="List">
										<img src="./files/view_tree.png" alt="List" style="border: 0px; margin: 1px; width: 32px; height: 32px; vertical-align: middle;">
									</button>
                                    <br>
                                    <span style="font-size: 80%;"> <a
                                            href="{{url("directory?route={$route}")}}">{{$route}}</a>
                                        </span>
                                </form>
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
                                                <a  id="smallbutton" onclick="newDirectory('{{$route}}')">پوشه جدید</a>
                                                <a id="smallbutton" href='{{url("upload-text?route={$route}")}}'>فایل جدید</a>
                                                <a id="smallbutton" href='{{url("upload-file?route={$route}")}}'>آپلود</a>
                                                <a id="smallbutton">انتقال</a>
                                                <a id="smallbutton">حذف</a>
                                                <a id="smallbutton">دانلود</a>
                                            </td>
                                            {{-- <td valign="top" style="text-align: right;">
                                                <div style="margin-top: 3px;">
                                                    <input type="button" id="smallbutton" value="دانلود"
                                                        title="Download a zip file containing all selected entries (accesskey x)"
                                                        accesskey="x">
                                                </div>
                                            </td>  --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <ul id="items">
                    @foreach ($directories as $dir)
                        <li>
                            <div class="item-title">
                                <input type="checkbox" /> <img src="files/folder.png" /> {{ $dir['name'] }}
                            </div>

                            <div class="items-meta">
                                <a href='{{url("delete-file?route={$dir['route']}")}}'>حذف</a> -
                                <a onclick="moveFile( '{{$dir['route']}}' )">انتقال</a> -
                                <a onclick="changeName( '{{$dir['route']}}' )">تغییر نام</a>
                            </div>
                        </li>
                    @endforeach
                    @foreach ($files as $file)
                        <li>
                            <div class="item-title">
                                <input type="checkbox" />
                                <p class="item-title-inner">{{ $file['filename'] }}</p>
                            </div>
                            <div class="item-prob">
                                <p>{{ $file['filename'] }}</p> -
                                <p>{{ $file['size'] }}mb</p> -
                                <p>Last Modify : {{ $file['modify'] }}</p>
                            </div>
                            <div class="items-meta">
                                <a href='{{url("delete-file?route={$file['route']}")}}'>حذف</a> -
                                @if(array_search($file['ext'],$imageExtensions) === false) <a href='{{url("edit-txt?route={$file['route']}")}}'>ویرایش</a> - @else <span></span> @endIf
                                <a href="#">نمایش</a> -
                                <a onclick="moveFile( '{{$file['route']}}' )">انتقال</a> -
                                <a onclick="changeName( '{{$file['route']}}' )">تغییر نام</a>
                            </div>
                        </li>
                    @endforeach

                </ul>
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

	<script src="{{asset('assets/script.js')}}"></script>
</body>

</html>
