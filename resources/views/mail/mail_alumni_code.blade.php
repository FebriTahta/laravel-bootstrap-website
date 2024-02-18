<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<!--[if gte mso 9]>
	<xml>
		<o:OfficeDocumentSettings>
		<o:AllowPNG/>
		<o:PixelsPerInch>96</o:PixelsPerInch>
		</o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Fira+Mono:400,500,700|Ubuntu:400,400i,500,500i,700,700i" rel="stylesheet" />
    <!--<![endif]-->
	<title>Email Template</title>
	<!--[if gte mso 9]>
	<style type="text/css" media="all">
		sup { font-size: 100% !important; }
	</style>
	<![endif]-->
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#2e57ae; -webkit-text-size-adjust:none }
		a { color:#000001; text-decoration:none }
		p { padding:0 !important; margin:0 !important } 
		img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
		.mcnPreviewText { display: none !important; }
		
		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			
			.m-center { text-align: center !important; }
			.text3,
			.text-footer,
			.text-header { text-align: center !important; }
			
			.center { margin: 0 auto !important; }
			
			.td { width: 100% !important; min-width: 100% !important; }
			
			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }
			.p30-15-0 { padding: 30px 15px 0px 15px !important; }
			.p40 { padding-bottom: 30px !important; }
			.box,
			.footer,
			.p15 { padding: 15px !important; }
			.h2-white { font-size: 40px !important; line-height: 44px !important; text-align: center !important; }

			.h2 { font-size: 42px !important; line-height: 50px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }
			.container { padding: 0px !important; }
			.separator { padding-top: 30px !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-top,
			.column-dir,
			.column-empty,
			.column-empty2,
			.column-bottom,
			.column-dir-top,
			.column-dir-bottom { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 10px !important; }
			.column-empty2 { padding-bottom: 30px !important; }

			.content-spacing { width: 15px !important; }
		}
	</style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#2e57ae; -webkit-text-size-adjust:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" valign="top" class="container" style="padding:50px 10px;">
				<!-- Container -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center">
							<table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
								<tr>
									<td class="td" bgcolor="#ffffff" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
					
										<!-- CTA -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ee817a">
											<tr>
												<td class="p15" style="padding: 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="box" style="padding:40px 30px; border:1px solid #ffffff;">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td class="h3-white pb20" style="color:#ffffff; font-family:'Ubuntu', Arial,sans-serif; font-size:36px; line-height:40px; text-align:center; font-weight:bold; padding-bottom:20px;">Halo, {{ $emailData['alumni_name'] }}</td>
																	</tr>
																	<tr>
																		<td class="h4-white pb30" style="color:#ffffff; font-family:'Fira Mono', Arial,sans-serif; font-size:20px; line-height:24px; text-align:center; padding-bottom:30px;">
                                                                            Terimakasih sudah mengisi <br><strong>FORM PENDATAAN ALUMNI</strong>
                                                                            Gunakan kode <strong>{{$emailData['alumni_code']}}</strong> <br> untuk memberikan ulasan
                                                                        </td>
																	</tr>
																	<!-- Button -->
																	<tr>
																		<td align="center">
																			<table width="140" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																					<td class="text-button white-button" style="font-family:'Fira Mono', Arial,sans-serif; font-size:14px; line-height:18px; text-align:center; padding:12px; background:#ffffff; color:#ee817a;"><a href="https://smkkrian1.sch.id/ulasan" target="_blank" class="link2" style="color:#ee817a; text-decoration:none;"><span class="link2" style="color:#ee817a; text-decoration:none;">Beri Ulasan</span></a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<!-- END Button -->
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- END CTA -->
									</td>
								</tr>
								<tr>
									<td class="text-footer" style="padding-top: 30px; color:#9fadd4; font-family:'Fira Mono', Arial,sans-serif; font-size:12px; line-height:22px; text-align:center;">
										SMK 1 Krian Sidoarjo &copy; {{date('Y')}} All rights reserved <br /><a href="#" target="_blank" class="link4" style="color:#9fadd4; text-decoration:none;"><span class="link4" style="color:#9fadd4; text-decoration:none;">{{$emailData['alumni_subject']}}</span></a> | <a href="#" target="_blank" class="link4" style="color:#9fadd4; text-decoration:none;"><span class="link4" style="color:#9fadd4; text-decoration:none;">Update Preferences</span></a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!-- END Container -->
			</td>
		</tr>
	</table>
</body>
</html>
