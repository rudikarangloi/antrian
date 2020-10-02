var xmlHttp = createXmlHttpRequestObject();
function createXmlHttpRequestObject()
{
	var xmlHttp;
	if(window.ActiveXObject)
	{
		try 
			{xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");}
		catch (e) 
			{xmlHttp = false;}
	}
	else
	{
		try 
			{xmlHttp = new XMLHttpRequest();}
		catch (e) 
			{xmlHttp = false;}
	}
	
	if (!xmlHttp) 
		{alert("Obyek XMLHttpRequest gagal dibuat");}
	else 
		{return xmlHttp;}
}

function func_select(CrT,gFrM,rFrM,gALL)
{
	
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		if (CrT=="CrFAK")
		{
			gMST = encodeURIComponent(document.getElementById(gFrM).value);
			//alert(gMST); return false;
			xmlHttp.open("GET", "global.php?CrT="+CrT+"&gMST="+gMST, true);
			xmlHttp.onreadystatechange = function(){handleServerResponseFRM(CrT,rFrM,gALL);}
			xmlHttp.send(null);
		}
	}
	else setTimeout('select()', 1000);
}

function handleServerResponseFRM(CrT,rFrM,gALL)
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;
			//alert(CrT); return false;
			ArrMisi     = xmlRoot.getElementsByTagName("ArrMisi");
			ArrMisiKey  = xmlRoot.getElementsByTagName("ArrMisiKey");
			
			
			if (gALL=="LoadNuL") {htmlA= "<option value=''></option>";}
			else if (gALL=="LoadALL") {htmlA= "<option value='%'>ALL</option>";}
			else {htmlA= "";}
			for (var i=0; i<ArrMisi.length; i++)
			{
				if (CrT=="CrFAK")
				{
					//alert(CrT); return false;
					htmlA += "<option value='"+ArrMisiKey.item(i).firstChild.data+"'>"+ArrMisi.item(i).firstChild.data+"</option>";
				}
				else
				{
					htmlA += "<option value='"+ArrMisiKey.item(i).firstChild.data+ "'>"+ArrMisiKey.item(i).firstChild.data+" : "+ArrMisi.item(i).firstChild.data+"</option>";
				}
			}
			document.getElementById(rFrM).innerHTML = htmlA;
			func_view_data();
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
	/////////////
}

function func_view_data()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.setRequestHeader("Content-length", param.length);
			xmlHttp.setRequestHeader("Connection", "close");
			xmlHttp.send(param);
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function fCariGLOBAL(CrT,gVL)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		gMST = "";
		xmlHttp.open("GET", "global.php?CrT="+CrT+"&gMST="+gMST+"&gVL="+gVL, true);
		xmlHttp.onreadystatechange = function(){handleServerResponseNiL(CrT);}
		xmlHttp.send(null);
	}
	else 
	{
		setTimeout('select()', 1000);
	}
}

function fCariBPJSep(CrT,gVL,sCrt,sIdc,sKey,gNoRM,gLaYR,gDiAK,gLakA,gKelK,gRjNK,gRjPK,gInSK)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		nSeP = '';
		if (CrT=='BpJKSEP_UpD'){
			nSeP = document.getElementById('fSEPP').value; 
		}
		gLokA  = document.getElementById('fLokA').value;
		gCatA  = document.getElementById('fCatA').value;
		
		TglSEP = document.getElementById('fTgLM').value;
		JamSEP = document.getElementById('fJaMM').value;
		
		TglRJK = document.getElementById('fTgLR').value;
		JamRJK = document.getElementById('fJaMR').value;
		
		xmlHttp.open("GET", "global.php?TglSEP="+TglSEP+"&JamSEP="+JamSEP+"&TglRJK="+TglRJK+"&JamRJK="+JamRJK+"&gLokA="+gLokA+"&gCatA="+gCatA+"&nSeP="+nSeP+"&CrT="+CrT+"&gVL="+gVL+"&sCrt="+sCrt+"&sIdc="+sIdc+"&sKey="+sKey+"&gPoLi="+gLaYR+"&gNoRM="+gNoRM+"&gDiAK="+gDiAK+"&gLakA="+gLakA+"&gKelK="+gKelK+"&gRjNK="+gRjNK+"&gRjPK="+gRjPK+"&gInSK="+gInSK, true);
		xmlHttp.onreadystatechange = function(){handleServerResponseBPJS(CrT);}
		xmlHttp.send(null);
	}
	else 
	{
		setTimeout('select()', 1000);
	}
}

function fCariBPJS(CrT,gVL,sCrt,sIdc,sKey)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		
		/*if (document.getElementById('ffaskes').checked) {
			gfaskes = 1;
		}
		else{
			gfaskes = 0;
		}
		*/
		gfaskes = 0;
		xmlHttp.open("GET", "global.php?CrT="+CrT+"&gVL="+gVL+"&sCrt="+sCrt+"&sIdc="+sIdc+"&sKey="+sKey+"&gfaskes="+gfaskes, true);
		xmlHttp.onreadystatechange = function(){handleServerResponseBPJS(CrT);}	
		xmlHttp.send(null);
	
	}
	else 
	{
		setTimeout('select()', 1000);
	}
}

function handleServerResponseBPJS(CrT)
{		

	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;


			if (CrT=='BpJK')
			{			
				
				ArrBPJS = xmlRoot.getElementsByTagName("ArrBPJS");
				var rCdE = ArrBPJS.item(0).firstChild.data;
				console.log(rCdE);
				var rMeS = ArrBPJS.item(1).firstChild.data;
				document.getElementById('fBpJK').value= ArrBPJS.item(2).firstChild.data;
				document.getElementById('fKtEP').value= ArrBPJS.item(3).firstChild.data;
				
				if (rCdE==200)
				{
					document.getElementById('fNmaB').value= ArrBPJS.item(4).firstChild.data;
					document.getElementById('fStaK').value= ArrBPJS.item(5).firstChild.data;
					document.getElementById('fStaD').value= ArrBPJS.item(6).firstChild.data;
					document.getElementById('fKelK').value= ArrBPJS.item(7).firstChild.data;
					document.getElementById('fKelD').value= ArrBPJS.item(8).firstChild.data;
					document.getElementById('fJnpK').value= ArrBPJS.item(9).firstChild.data;
					document.getElementById('fJnpD').value= ArrBPJS.item(10).firstChild.data;
					document.getElementById('fFskK').value= ArrBPJS.item(11).firstChild.data;
					document.getElementById('fFskD').value= ArrBPJS.item(12).firstChild.data;
					
					splits = ArrBPJS.item(13).firstChild.data.split("-", 3);
					document.getElementById('fTgTA').value= splits[2]+'-'+splits[1]+'-'+splits[0];
					splits = ArrBPJS.item(14).firstChild.data.split("-", 3);
					document.getElementById('fTgTM').value= splits[2]+'-'+splits[1]+'-'+splits[0];
					splits = ArrBPJS.item(15).firstChild.data.split("-", 3);
					document.getElementById('fTgTC').value= splits[2]+'-'+splits[1]+'-'+splits[0];
					
					document.getElementById('fntlp').value= ArrBPJS.item(16).firstChild.data;
					//PPK RUJUKAN AUTO
					//document.getElementById('fRjPK').value= ArrBPJS.item(11).firstChild.data;
					
					//alert(ArrBPJS.item(15).firstChild.data);
					//Auto display kelas
					//kdKls = ArrBPJS.item(7).firstChild.data;
					//fCariGLOBAL('KlSK',kdKls);
					
				}
				else
				{
					
					document.getElementById('fNmaB').value= "";
					document.getElementById('fStaK').value= "";
					document.getElementById('fStaD').value= "NON AKTIF";
					document.getElementById('fKelK').value= "";
					document.getElementById('fKelD').value= "";
					document.getElementById('fJnpK').value= "";
					document.getElementById('fJnpD').value= "";
					document.getElementById('fFskK').value= "";
					document.getElementById('fFskD').value= "";
					document.getElementById('fTgTA').value= "";
					document.getElementById('fTgTM').value= "";
					document.getElementById('fTgTC').value= "";
				}
				//alert(ArrBPJS.item(15).firstChild.data);
				$("#loadingImg").hide();
				display_data();
			}
		}
	}
}

function fCariBPJS_old(CrT,gVL,sCrt,sIdc,sKey)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		xmlHttp.open("GET", "global.php?CrT="+CrT+"&gVL="+gVL+"&sCrt="+sCrt+"&sIdc="+sIdc+"&sKey="+sKey, true);
		xmlHttp.onreadystatechange = function(){
			handleServerResponseBPJS(CrT);
		}
		xmlHttp.send(null);
	}
	else 
	{
		setTimeout('select()', 1000);
	}
}

function handleServerResponseBPJS_old(CrT)
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;
			if (CrT=='BpJKSEP_CrT' || CrT=='BpJKSEP_UpD')
			{
				var ArrSEP = xmlRoot.getElementsByTagName("ArrSEP");
				var rCdE = ArrSEP.item(0).firstChild.data;
				var rMeS = ArrSEP.item(1).firstChild.data;
				if (rCdE==200){
					if (CrT=='BpJKSEP_UpD'){
						alert('Update SEP : '+rMeS+', berhasil...!!');
					}
					else{
						alert('Insert SEP berhasil, Nomor SEP : '+rMeS);
						$("#BPJ1").hide();
						$("#BPJ2").show();
						$("#BPJ3").show();
					}
					document.getElementById('fSEPP').value= rMeS;
					prosesSaveSEP(rMeS);
				}
				else
				{
					alert(rMeS);
					//$("#BPJ1").show();
					//$("#BPJ2").show();
					//$("#BPJ3").show();
				}
				$("#loadingImg").hide();
				display_data();
			}
			
			if (CrT=='BpJK')
			{
				ArrBPJS = xmlRoot.getElementsByTagName("ArrBPJS");
				var rCdE = ArrBPJS.item(0).firstChild.data;
				console.log(rCdE);
				var rMeS = ArrBPJS.item(1).firstChild.data;
				document.getElementById('fBpJK').value= ArrBPJS.item(2).firstChild.data;
				document.getElementById('fKtEP').value= ArrBPJS.item(3).firstChild.data;
				if (rCdE==200)
				{
					document.getElementById('fNmaB').value= ArrBPJS.item(4).firstChild.data;
					document.getElementById('fStaK').value= ArrBPJS.item(5).firstChild.data;
					document.getElementById('fStaD').value= ArrBPJS.item(6).firstChild.data;
					document.getElementById('fKelK').value= ArrBPJS.item(7).firstChild.data;
					document.getElementById('fKelD').value= ArrBPJS.item(8).firstChild.data;
					document.getElementById('fJnpK').value= ArrBPJS.item(9).firstChild.data;
					document.getElementById('fJnpD').value= ArrBPJS.item(10).firstChild.data;
					document.getElementById('fFskK').value= ArrBPJS.item(11).firstChild.data;
					document.getElementById('fFskD').value= ArrBPJS.item(12).firstChild.data;
					
					splits = ArrBPJS.item(13).firstChild.data.split("-", 3);
					document.getElementById('fTgTA').value= splits[2]+'-'+splits[1]+'-'+splits[0];
					splits = ArrBPJS.item(14).firstChild.data.split("-", 3);
					document.getElementById('fTgTM').value= splits[2]+'-'+splits[1]+'-'+splits[0];
					splits = ArrBPJS.item(15).firstChild.data.split("-", 3);
					document.getElementById('fTgTC').value= splits[2]+'-'+splits[1]+'-'+splits[0];
					
					//PPK RUJUKAN AUTO
					//document.getElementById('fRjPK').value= ArrBPJS.item(11).firstChild.data;
					
					//alert(ArrBPJS.item(15).firstChild.data);
					//Auto display kelas
					kdKls = ArrBPJS.item(7).firstChild.data;
					fCariGLOBAL('KlSK',kdKls);
				}
				else
				{
					alert(rMeS);
					document.getElementById('fNmaB').value= "";
					document.getElementById('fStaK').value= "";
					document.getElementById('fStaD').value= "NON AKTIF";
					document.getElementById('fKelK').value= "";
					document.getElementById('fKelD').value= "";
					document.getElementById('fJnpK').value= "";
					document.getElementById('fJnpD').value= "";
					document.getElementById('fFskK').value= "";
					document.getElementById('fFskD').value= "";
					document.getElementById('fTgTA').value= "";
					document.getElementById('fTgTM').value= "";
					document.getElementById('fTgTC').value= "";
				}
				//alert(ArrBPJS.item(15).firstChild.data);
				$("#loadingImg").hide();
				display_data();
			}
		}
	}
}

function handleServerResponseNiL(CrT)
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;
			var TrG = "";
			//ta registrasi
			if (CrT=="LaYK" || CrT=="KlSK" || CrT=="JmNK" || CrT=="TrFK" || CrT=="MsKK" || CrT=="RjKK" || CrT=="InPK" || CrT=="NoRM" || CrT=="SmFK" || CrT=="DiAK")
			{
				if (CrT=="NoRM")
				{
					ArrNoRM = xmlRoot.getElementsByTagName("ArrNoRM");
					rFind = ArrNoRM.item(1).firstChild.data;
					if (rFind=="None"){
						alert('Pasien tidak ditemukan..!!'); return false;
					}
					document.getElementById('fNoRM').value= ArrNoRM.item(0).firstChild.data;
					document.getElementById('fNmAP').value= ArrNoRM.item(1).firstChild.data;
					document.getElementById('fAlM1').value= ArrNoRM.item(2).firstChild.data;
					document.getElementById('fAlM2').value= ArrNoRM.item(3).firstChild.data;
					document.getElementById('fKoTP').value= ArrNoRM.item(4).firstChild.data;
					document.getElementById('fJeNK').value= ArrNoRM.item(5).firstChild.data;
					document.getElementById('fKnJK').value= ArrNoRM.item(6).firstChild.data;
					document.getElementById('fBpJK').value= ArrNoRM.item(7).firstChild.data;
					display_data();
				}
				else
				{
					ArrDatK = xmlRoot.getElementsByTagName("ArrDatK");
					ArrDatD = xmlRoot.getElementsByTagName("ArrDatD");
					if (CrT=="LaYK")
					{
						ArrInsK = xmlRoot.getElementsByTagName("ArrInsK");
						ArrInsD = xmlRoot.getElementsByTagName("ArrInsD");
						ArrInsB = xmlRoot.getElementsByTagName("ArrInsB");
						ArrKcsK = xmlRoot.getElementsByTagName("ArrKcsK");
					}
					
					if (ArrDatD.item(0).firstChild.data=="none")
					{
						showGLOB('',CrT,'');
					}
					else
					{
						document.getElementById('f'+CrT.substring(0,3)+'K').value= ArrDatK.item(0).firstChild.data;
						document.getElementById('f'+CrT.substring(0,3)+'D').value= ArrDatD.item(0).firstChild.data;
						if (CrT=="LaYK")
						{
							tCode = "";
							tNama = "";
							tLayN = ArrDatK.item(0).firstChild.data;
							if (tLayN=='RI005'){
								tCode = "004";
								tNama = "VIP";
								TrG   ="JmNK";
							}
							if (tLayN=='RI007'){
								tCode = "005";
								tNama = "SUPER VIP";
							}
							if (tLayN=='RI008'){
								tCode = "009";
								tNama = "ICU/ICCU/NICU/PICU";
							}
							
							if (tLayN.substring(0,2)=='RD' || tLayN.substring(0,2)=='RJ'){
							
								tCode = "006";
								tNama = "TANPA KELAS";
							}
							
							//auto kelas
							document.getElementById('fKlSK').value= tCode;
							document.getElementById('fKlSD').value= tNama;
							
							document.getElementById('fInSK').value= ArrInsK.item(0).firstChild.data;
							document.getElementById('fInSD').value= ArrInsD.item(0).firstChild.data;
							
							//auto ref bpjs
							document.getElementById('fLaYR').value= ArrInsB.item(0).firstChild.data;
							
							//auto karcis
							document.getElementById('fTrFK').value= ArrKcsK.item(0).firstChild.data;
							document.getElementById('fTrFD').value= ArrKcsK.item(1).firstChild.data;
						}
						if (CrT=="RjKK")
						{
							document.getElementById('fRjPK').value= ArrDatD.item(1).firstChild.data;
						}
						if (CrT=="TrFK")
						{
							document.getElementById('fBiAK').value= ArrDatD.item(1).firstChild.data;
							document.getElementById('fTuNK').value= ArrDatD.item(1).firstChild.data;
						}
						
						if (CrT=='LaYK'){
							if (tCode){
								TrG = "JmNK";
							}
							else{
								TrG = "KlSK";
							}
						}
						else if (CrT=='KlSK'){
							if (document.getElementById('fLaYK').value==''){
								TrG="LaYK";
							}
							else{
								TrG="JmNK";
							}
						}
						else if (CrT=='JmNK'){TrG="TrFK";}
						else if (CrT=='TrFK'){TrG="MsKK";}
						else if (CrT=='MsKK'){TrG="RjKK";}
						//else if (CrT=='RjKK'){TrG="InPK";}
						else if (CrT=='RjKK'){TrG="RjNK";}
						else if (CrT=='InPK'){TrG="IbUK";}
						
						if (TrG){
							document.getElementById('f'+TrG).focus();
						}
						display_data();
					}
				}
			}
			
			//data sosial
			else if (CrT=="KwNK" || CrT=="KrJK" || CrT=="DiDK" || CrT=="AgAK" || CrT=="SkUK" || CrT=="KeLK" || CrT=="LoKA" || CrT=="KoDK" || CrT=="BaNG" || CrT=="TrNK")
			{
				//alert(CrT); return false;
				ArrGLOB = xmlRoot.getElementsByTagName("ArrGLOB");
				if (ArrGLOB.item(1).firstChild.data=="none")
				{
					showGLOBNoRM('',CrT,'');
				}
				else
				{
					if (CrT=="LoKA" || CrT=="BaNG"){
						document.getElementById('f'+CrT.substring(0,4)+'K').value= ArrGLOB.item(0).firstChild.data;
						document.getElementById('f'+CrT.substring(0,4)+'D').value= ArrGLOB.item(1).firstChild.data;
					}
					else
					{
						document.getElementById('f'+CrT.substring(0,3)+'K').value= ArrGLOB.item(0).firstChild.data;
						document.getElementById('f'+CrT.substring(0,3)+'D').value= ArrGLOB.item(1).firstChild.data;
						
						if (CrT=="KoDK"){
							/*Pemesanan BED*/
							document.getElementById('fKaMD').value= ArrGLOB.item(2).firstChild.data;
							document.getElementById('fBaND').value= ArrGLOB.item(3).firstChild.data;
							document.getElementById('fTaRF').value= ArrGLOB.item(4).firstChild.data;
						}
						if (CrT=="TrNK"){
							document.getElementById('fTrFK').value= ArrGLOB.item(2).firstChild.data;
						}
					}
					
					if (CrT=="KeLK")
					{
						document.getElementById('fKecD').value= ArrGLOB.item(2).firstChild.data;
						document.getElementById('fKabD').value= ArrGLOB.item(3).firstChild.data;
						document.getElementById('fProD').value= ArrGLOB.item(4).firstChild.data;
					}
					
					if (CrT=='KwNK'){TrG="KrJK";}
					else if (CrT=='KrJK'){TrG="DiDK";}
					else if (CrT=='DiDK'){TrG="AgAK";}
					else if (CrT=='AgAK'){TrG="SkUK";}
					else if (CrT=='SkUK'){TrG="KeLK";}
					
					if (TrG){
						document.getElementById('f'+TrG).focus();
					}
					display_data();
				}
			}
			
			//transaksi tindakan
			else if (CrT=="TrLaYK" || CrT=="TrKlSK" || CrT=="TrTpTK" || CrT=="TrKdeK" || CrT=="TrDepK" || CrT=="TrKeGK" || CrT=="TrAnEK" || CrT=="TrGoBK")
			{
				ArrDatK = xmlRoot.getElementsByTagName("ArrDatK");
				ArrDatD = xmlRoot.getElementsByTagName("ArrDatD");
				document.getElementById('f'+CrT.substring(0,5)+'K').value= ArrDatK.item(0).firstChild.data;
				document.getElementById('f'+CrT.substring(0,5)+'D').value= ArrDatD.item(0).firstChild.data;
				
				if (CrT=="TrKdeK" || CrT=="TrTpTK"){
					var kde = "";
					if (CrT=="TrKdeK"){
						kde = ArrDatK.item(0).firstChild.data;
					}
					else if (CrT=="TrTpTK"){
						kde = document.getElementById('fTrKdeK').value;
					}
					refresh_komponen_hrga('',kde);
				}
				display_data();
			}
			//transaksi keluar
			else if (CrT=="JmNSK" || CrT=="JmNLK")
			{
				ArrGLOB = xmlRoot.getElementsByTagName("ArrGLOB");
				document.getElementById('f'+CrT.substring(0,4)+'K').value= ArrGLOB.item(0).firstChild.data;
				document.getElementById('f'+CrT.substring(0,4)+'D').value= ArrGLOB.item(1).firstChild.data;
				if (CrT=='JmNSK'){
					$("#fSuBSPL").focus();
					$("#fSuBSPL").select();
				}
				if (CrT=='JmNLK'){
					$("#fLaINPL").focus();
					$("#fLaINPL").select();
				}
				display_data();
			}
			else
			{
				
			}
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function handleServerResponseNull()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			display_data();
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function display_data()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.setRequestHeader("Content-length", param.length);
			xmlHttp.setRequestHeader("Connection", "close");
			xmlHttp.send(param);
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function RefText(crt)
{
	return encodeURIComponent(crt);
}

function ReplaceText(gFnD)
{
	for (i=1; i<=100; i++)
	{
		gFnD = gFnD.replace(' ','**');
	}
	return gFnD;
}

function ReplaceSpace(gFnD)
{
	for (i=1; i<=100; i++)
	{
		gFnD = gFnD.replace(' ','');
	}
	return gFnD;
}

function addSeparator(fldID)
{
	var posCaret = getPosition(fldID); 
	var fldVal   = fldID.value;
	
	if((fldVal.length === 3 || 7 || 11 ) && (fldVal.length === posCaret)) 
	{ 
		posCaret = posCaret +1;  
	}
	
	//nStr = fldVal.replace(/,/g,'');
	nStr = fldVal.replace(/\./g,'');
	nStr += ''; 
	//x = nStr.split('.');
	x = nStr.split(',');
	x1 = x[0];
	//x2 = x.length > 1 ? '.' + x[1] : '';
	x2 = x.length > 1 ? ',' + x[1] : '';
	
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) 
	{ 
		x1 = x1.replace(rgx, '$1' + '.' + '$2');  //awalnya pake ',' (koma)
	}
	
	fldID.value = x1 + x2; 
	setCaretPosition(fldID, posCaret);
}

function addSeparatorDate(fldID)
{
	var temp="";
	for (var i=0; i<fldID.value.length; i++)
	{
		rD=fldID.value.substring(i, i+1);
		if ((i==2 || i==5)&& rD!='-'){
			temp = temp+"-"+fldID.value.substring(i, i+1);
		}
		else{
			temp = temp+fldID.value.substring(i, i+1);
		}
	}
	
	fldID.value = temp;
	setCaretPosition(fldID, posCaret);
}

function addSeparatorTime(fldID)
{
	var temp="";
	for (var i=0; i<fldID.value.length; i++)
	{
		rD=fldID.value.substring(i, i+1);
		if ((i==2 || i==5)&& rD!=':'){
			temp = temp+":"+fldID.value.substring(i, i+1);
		}
		else{
			temp = temp+fldID.value.substring(i, i+1);
		}
	}
	
	fldID.value = temp;
	setCaretPosition(fldID, posCaret);
	
}

function setCaretPosition(elem, caretPos) 
{
	if(elem != null) 
	{
		if(elem.createTextRange) 
		{
			var range = elem.createTextRange();
			range.move('character', caretPos);
			range.select();
		}
		else 
		{
			if(elem.selectionStart) 
			{
				elem.focus();
				elem.setSelectionRange(caretPos, caretPos);
			}
			else
			{
				elem.focus();
			}
		}
	}
}

function getPosition(amtFld)
{
	var iCaretPos = 0;
	if (document.selection) 
	{ 
		amtFld.focus ();
		var oSel = document.selection.createRange ();
		oSel.moveStart ('character', - amtFld.value.length);
		iCaretPos = oSel.text.length;
	}
	else if (amtFld.selectionStart || amtFld.selectionStart == '0')
	{
		iCaretPos = amtFld.selectionStart;
	}
	
	return(iCaretPos);
}

function NumValidate(field)
{
	if (field.value.length==0)
	{window.alert("Input nilai error..!!"); return false;}
	else
	{
		var valid = "0123456789,."
		var ok = "yes";
		var temp;
		for (var i=0; i<field.value.length; i++)
		{
			temp = "" + field.value.substring(i, i+1);
			if (valid.indexOf(temp) == "-1") ok = "no";
		}
		
		if (ok == "no")
		{
			alert("Input nilai error..!!");
			field.focus();
			field.select();
			return false;
		}
	}
}

function fConvertToRupiahJava(xD)
{
	var fval = String(xD);
	nStr = fval.replace(/\./g,'');
	nStr += ''; 
	x = nStr.split(',');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) 
	{
		x1 = x1.replace(rgx, '$1' + '.' + '$2');  //awalnya pake ',' (koma)
	}
	return x1 + x2; 
}

function MessWarning(xM)
{
	alert(xM);
}

function ToNumeric(gD)
{
	if (gD==''){gD=0;}
	for (i=1; i<=10; i++)
	{
		gD = gD.replace('.','');
	}
	return gD;
}
