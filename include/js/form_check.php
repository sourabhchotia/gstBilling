<script language="javascript">
var form = "";
var submitted = false;
var error = false;
var error_message = "";

/* function check_input(field_name, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == '') {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_email(field_name, message , message1) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;
    if (field_value == '') {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
	else
	{
	  if (field_value.indexOf('.') == 0 || field_value.indexOf('.') == -1 || field_value.indexOf('@') == 0 || field_value.indexOf('@') == -1 || field_value.indexOf('.') == field_value.length - 1 || field_value.indexOf(',') >= 0) {
       error_message = error_message + "* " + message1 + "\n";
       error = true;
	  }
    }
  }
}
 */function isNumeric(stext)
{
var num='0123456789';
var check=true;
for(var i=0;i<stext.length && check==true;i++)
{
var chr=stext.charAt(i);
if(num.indexOf(chr)==-1)
{
check=false;
return check;
}
}
return check;
}

function check_radio(field_name, message) {
  var isChecked = false;
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

/* function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_password(field_name_1, field_name_2, message_1, message_2) {
 
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;
     if (password == '' ) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}
function check_password_confirm(field_name_1, field_name_2, message_2) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;
    if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }


function SaveModifications(ID)
	{
		if(ValidateContents(ID))
		{
			var confirmsave = window.confirm("Are you sure you want to save the modifications you have made?")
			if (confirmsave)
			{
				eval("document.addnews"+ID+".target='_self'");
				eval("document.addnews"+ID+".long_desc.value=editor.GetHTML()");
				eval("document.addnews"+ID+".action='admin_area.php?content=news&action=news_edit'");
				eval("document.addnews"+ID+".submit()");
			}
		}
	}
function Add(ID)
	{
		if(ValidateContents(ID))
		{
			var confirmsave = window.confirm("Are you sure you want to add this News?")
			if (confirmsave)
			{
				eval("document.addnews"+ID+".long_desc.value=editor.GetHTML()");
				eval("document.addnews"+ID+".target='_self'");
				eval("document.addnews"+ID+".action='admin_area.php?content=news&action=news_add'");
				eval("document.addnews"+ID+".submit()");
			}
		} 
	}
 */function Add_NewsLetter(ID)
	{
		if(ValidateNewsLetter(ID))
		{
			var confirmsave = window.confirm("Are you sure you want to add this Newsletter?")
			if (confirmsave)
			{
				eval("document.addnews"+ID+".long_desc.value=editor.GetHTML()");
				eval("document.addnews"+ID+".target='_self'");
					eval("document.addnews"+ID+".submit()");
			}
		} 
	}
	function Save_NewsLetter(ID)
	{
		if(ValidateNewsLetter(ID))
		{
			var confirmsave = window.confirm("Are you sure you want to save the modifications you have made?")
			if (confirmsave)
			{
				eval("document.addnews"+ID+".long_desc.value=editor.GetHTML()");
				eval("document.addnews"+ID+".target='_self'");
				eval("document.addnews"+ID+".submit()");
			}
		} 
	}
	
function ValidateNewsLetter(ID)
   	{		
		if (eval("document.addnews"+ID+".title.value")=="")
		{
			alert("Please enter a title for the newsletter.");
			eval("document.addnews"+ID+".title.focus()");
			return false;
		}
		return true;
    }	

function Send_Reply(ID,eID)
	{
		if(ValidateReply(ID))
		{
			var confirmsave = window.confirm("Are you sure you want to send this reply?")
			if (confirmsave)
			{
				eval("document.addnews"+ID+".long_desc.value=editor.GetHTML()");
				eval("document.addnews"+ID+".target='_self'");
				eval("document.addnews"+ID+".submit()");
			}
		} 
	}
function ValidateReply(ID)
   	{		
		if (eval("document.addnews"+ID+".title.value")=="")
		{
			alert("Please enter a title for the reply.");
			eval("document.addnews"+ID+".title.focus()");
			return false;
		}
		return true;
    }			
function ValidateContents(ID)
   	{		
		if (eval("document.addnews"+ID+".title.value")=="")
		{
			alert("Please enter a title for the news.");
			eval("document.addnews"+ID+".title.focus()");
			return false;
		}
		if (eval("document.addnews"+ID+".short_desc.value")=="")
		{
			alert("Please enter short description for the news.");
			eval("document.addnews"+ID+".short_desc.focus()");
			return false;
		}
		return true;
    }
	function check_banner(theForm)
   	{		
		if (theForm.title.value=="")
		{
			alert("Please enter a title for the banner.");
			theForm.title.focus();
			return false;
		}
		if (theForm.url.value=="")
		{
			alert("Please enter url for the banner.");
			theForm.url.focus();
			return false;
		}
		if (theForm.file.value=="")
		{
			alert("Please select a image for the banner.");
			theForm.file.focus();
			return false;
		}
		return true;
    }
	// newsletter
	function SelectAllItemsInList(FormName,ListName)
	  {
			eval('document.'+FormName+'.SelectedEmail.value=""');
			for (var i=eval('document.'+FormName+'.'+ListName+'.options.length')-1; i>=0; i--)
			{
				if (eval('document.'+FormName+'.SelectedEmail.value==""'))
				{
					eval('document.'+FormName+'.SelectedEmail.value= document.'+FormName+'.SelectedEmail.value + document.'+FormName+'.'+ListName+'.options['+i+'].text');
				}
				else
				{
				eval('document.'+FormName+'.SelectedEmail.value= document.'+FormName+'.SelectedEmail.value + "," + document.'+FormName+'.'+ListName+'.options['+i+'].text');
				}
		   	  eval('document.'+FormName+'.'+ListName+'.options['+i+'].selected=true')
			}
		 }
	 function RemovePagesFromList(FormName,List1,List2)
        {
 	       if(!eval(FormName+'.'+List1+'.value')=="")
	        {	                  				
	          var ItemExistsInList = false
	          for (var i=eval('document.'+FormName+'.'+List1+'.options.length')-1; i>=0; i--)
	          {
			    s = eval(FormName+'.'+List1+'.selectedIndex')
			    if(eval('document.'+FormName+'.'+List1+'.options['+s+'].value')==eval('document.'+FormName+'.'+List1+'.options['+i+'].value')) 
				 {
			 	    ItemExistsInList = true
					eval('document.'+FormName+'.'+List1+'.options[s]=null');
	  			    break;
			     }
	          }		
	        }
	      else {
		    alert("Please Select A Product from the Right List to Remove !!")
	      }
	    DisplayListCount();
       }
	   function myRemoveAllPagesFromList(FormName,List1,List2)
			{
				var Source = document.getElementById(List1); 
                var Target = document.getElementById(List2); 
				//alert(Source.options[0].value);
                if ((Source != null) && (Target != null))
                { 
                //alert(Source.length);
                  for(var i=Source.length-1;i>=0;i--)
                    {
                       var newOption = new Option(); // Create a new instance of ListItem 
                        if(Source.options[0].text!=null )
                        {
                            newOption.text = Source.options[0].text; 
                            newOption.value = Source.options[0].value; 
                            Target.options[Target.length] = newOption; //Append the item in Target 
                        } 
                        Source.remove(0); //Remove the item from Source 
                    } 
				} 
                //alert(Target.length)
		        DisplayListCount();
           }
	   	function RemoveAllPagesFromList(FormName,List1,List2)
			{
   				for (var j=eval('document.'+FormName+'.'+List1+'.options.length')-1; j>=0; j--)
   				{
   					eval(FormName+'.'+List1+'.options['+j+'].selected=true')
   					if(!eval(FormName+'.'+List1+'.value')=="")
						{	                  				
							var ItemExistsInList = false
							for (var i=eval('document.'+FormName+'.'+List2+'.options.length')-1; i>=0; i--)
							{
					    		if(eval('document.'+FormName+'.'+List2+'.options['+i+'].value=='+FormName+'.'+List1+'.value'))
					    		{
					    			ItemExistsInList = true
		  							eval('document.'+FormName+'.'+List1+'.options[document.'+FormName+'.'+List1+'.selectedIndex]=null');
					    		}
							}
		  					if(!ItemExistsInList==true)		
	  						{
		  						eval('document.'+FormName+'.'+List2+'.options[document.'+FormName+'.'+List2+'.options.length]= new Option('+FormName+'.'+List1+'.options[' + j + '].text,'+FormName+'.'+List1+'.value)')
		  						eval('document.'+FormName+'.'+List1+'.options[document.'+FormName+'.'+List1+'.selectedIndex]=null');
		  					}		
			    		}
			    	}
		         	DisplayListCount();
           }
		function AddAllPagesToList(FormName,List1,List2)
    	{
     		if(all.style.display=='')
   			{
   				List2 = "all";
   			}
   			for (var j=eval('document.'+FormName+'.'+List2+'.options.length')-1; j>=0; j--)
   			{
   				eval(FormName+'.'+List2+'.options['+j+'].selected=true')
   				if(!eval(FormName+'.'+List2+'.value')=="")
   				{	                  				
  					var ItemExistsInList = false
					for (var i=eval('document.'+FormName+'.'+List1+'.options.length')-1; i>=0; i--)
					{
			    		if(eval('document.'+FormName+'.'+List1+'.options['+i+'].value=='+FormName+'.'+List2+'.value'))
			    		{
			    			ItemExistsInList = true
			    		}
					}		
  				   if(!ItemExistsInList==true)
				   {
					 eval('document.'+FormName+'.'+List1+'.options[document.'+FormName+'.'+List1+'.options.length]=new Option('+FormName+'.'+List2+'.value,'+FormName+'.'+List2+'.value)');
				   }
	   		    }
	    	}
		    DisplayListCount();
		}
function DisplayListCount()
    {
          SelectedUserCount.innerHTML = "<a class=lighth13><b>Selected Members Email: (" + frmNewslettersList.SelectedEmailAddresses.options.length + ")</b></a>";
          AvailableUserCount.innerHTML = "<a class=lighth13><b>Available Members Email: (" + frmNewslettersList.AvailableEmailAddresses.options.length + ")</b></a>";
	}
   function AddPagesFromList(FormName,List1,List2)
     {
       var fcount=eval('document.'+FormName+'.'+List1+'.options.length');
  	   if (!eval(FormName+'.'+List2+'.value')=="") 
	    {	                  				
  			var ItemExistsInList = false
	    	for (var i=eval('document.'+FormName+'.'+List1+'.options.length')-1; i>=0; i--)
		     {
			  if(eval('document.'+FormName+'.'+List1+'.options['+i+'].value=='+FormName+'.'+List2+'.value'))
			  {
			     ItemExistsInList = true
			     eval('document.'+FormName+'.'+List2+'.options[document.'+FormName+'.'+List2+'.selectedIndex]=null');
			  }
  		     }		
    	  	if(!ItemExistsInList==true)
	     	{
	          eval('document.'+FormName+'.'+List1+'.options[document.'+FormName+'.'+List1+'.options.length]=new Option('+FormName+'.'+List2+'.options[document.'+FormName+'.'+List2+'.selectedIndex].text,'+FormName+'.'+List2+'.options[document.'+FormName+'.'+List2+'.selectedIndex].value)');
              eval('document.'+FormName+'.'+List2+'.options[document.'+FormName+'.'+List2+'.selectedIndex]=null');
		    }
	    }
	    else {
		   alert("Please Select A Product from the Left List to Add !!")
	    }
	  DisplayListCount();
   }
   function AddNewEmailAddressInList(FormName,NewEmailAddress,ListName)
	{
	   var NewEmailAddressString=eval(FormName+"."+NewEmailAddress+".value")
	   
		if(NewEmailAddressString!="")
		{
		  if(isEmailValid(NewEmailAddressString))
			{               				
    			var ItemExistsInList = false
				for (var i=eval('document.'+FormName+'.'+ListName+'.options.length')-1; i>=0; i--)
				{
			   		if(eval('document.'+FormName+'.'+ListName+'.options['+i+'].value=='+FormName+'.'+NewEmailAddress+'.value'))
			   		{
			   			ItemExistsInList = true
			   		}
  				}		
  				if(!ItemExistsInList==true)
  				{
  					eval('document.'+FormName+'.'+ListName+'.options[document.'+FormName+'.'+ListName+'.options.length]=new Option('+FormName+'.'+NewEmailAddress+'.value,'+FormName+'.'+NewEmailAddress+'.value)');
  					DisplayListCount();
  					alert("New email address successfully added in the selected recepients list.");
  				}
  			    else
  				{
  					alert("The selected email address already exists in the list.");
  				}
			}
		 else
			{
				alert("Please enter a valid email address.");
			}
	    }
	    else
		  {
		  	alert("Please enter a valid email address.");
		  }
	}
function SendResponse(ResponseID,page)
 {
	if(frmNewslettersList.SelectedEmailAddresses.options.length!=0)
	{
		var confirmsave = window.confirm("Are you sure you want to send the selected newsletter to "+frmNewslettersList.SelectedEmailAddresses.options.length+" recepient(s)?")
		if (confirmsave)
  	    {
			frmNewslettersList.target="_self";
			SelectAllItemsInList('frmNewslettersList','SelectedEmailAddresses');
			frmNewslettersList.action=("admin_area.php?content=newsletter&nID="+ResponseID+"&action=newsletter_send&page=" + page);
			frmNewslettersList.submit();
	    }
	}
	else
	{
		alert("Please add email addresses in the Selected Recepients list to send the newsletter.");
	}
}
function DisplayListDetails(FormName,ListName)
	{
		if(eval('document.'+FormName+'.'+ListName+'.selectedIndex') == -1)
		return;
		SelectedUserDetails.innerHTML = "<a class=lighth13>" + eval('document.'+FormName+'.'+ListName+'.options[document.'+FormName+'.'+ListName+'.selectedIndex].text') + "</a>";
		
		DisplayListCount();
	}

function isEmailValid(sEmail) 
   	{
  	   if (sEmail.value == '' || sEmail.indexOf('.') == 0 || sEmail.indexOf('.') == -1 || sEmail.indexOf('@') == 0 || sEmail.indexOf('@') == -1 || sEmail.indexOf('.') == sEmail.length - 1 || sEmail.indexOf(',') >= 0) {
		 return false;
  	   } else {
		 return true;
		}
	}			        			          
	
	
//validation for new member	add/edit
function member_form(theForm)
{
  if(theForm.admin_username.value == "")
  {
    alert("Please enter username")
	theForm.admin_username.focus();
	return false;
  }
  if(theForm.admin_firstname.value == "")
  {
    alert("Please enter user's firstname")
	theForm.admin_firstname.focus();
	return false;
  }
  if(theForm.admin_lastname.value == "")
  {
    alert("Please enter user's lastname")
	theForm.admin_lastname.focus();
	return false;
  }
  if(theForm.admin_email_address.value == "")
  {
    alert("Please enter user's Email ID")
	theForm.admin_email_address.focus();
	return false;
  }
  if(!isEmailValid(theForm.admin_email_address.value))
  {
    alert("Please enter valid Email ID")
	theForm.admin_email_address.focus();
	return false;
  }
  if(theForm.admin_phone.value == "")
  {
    alert("Please enter user's Phone No.")
	theForm.admin_phone.focus();
	return false;
  }
  if(theForm.admin_groups_id.value == 3)
  {
		if(theForm.city.value==0)
		{
			alert("Please select your city.")
			theForm.city.focus();
			return false;
		}
  }
  return true;
}

//validation for account detail edit
function account_edit(theForm)
{
   if(theForm.admin_firstname.value == "")
   {
    alert("Please enter your first name")
	theForm.admin_firstname.focus();
	return false;
   }
   if(theForm.admin_lastname.value == "")
   {
    alert("Please enter your last name")
	theForm.admin_lastname.focus();
	return false;
   }
   if(theForm.admin_email_address.value == "")
   {
    alert("Please enter your Email ID")
	theForm.admin_email_address.focus();
	return false;
   }
   if(!isEmailValid(theForm.admin_email_address.value))
   {
    alert("Please enter valid Email ID")
	theForm.admin_email_address.focus();
	return false;
   }
   if(theForm.admin_phone.value == "")
   {
    alert("Please enter your Phone No.")
	theForm.admin_phone.focus();
	return false;
   }
  return true;
}

function config_check(theForm)
{
   if(theForm.configuration_value.value == "")
   {
    alert("Please enter value")
	theForm.configuration_value.focus();
	return false;
   } 
     return true;
}
// validaton for add edit master values

function edit_master(theForm)
{
   if(theForm.english_value.value == "")
   {
    alert("Please enter english value")
	theForm.english_value.focus();
	return false;
   } 
     return true;
}

function add_master(theForm)
{
   if(theForm.title.value == "")
   {
    alert("Please enter title of heading")
	theForm.title.focus();
	return false;
   } 
   if(theForm.define_key.value == "")
   {
    alert("Please enter define key of heading")
	theForm.define_key.focus();
	return false;
   } 
   if(theForm.english_value.value == "")
   {
    alert("Please enter english value")
	theForm.english_value.focus();
	return false;
   }
    if(theForm.desc.value == "")
   {
    alert("Please enter description")
	theForm.desc.focus();
	return false;
   }
     return true;
}

function property_check(theForm)
{
   if(theForm.title.value == "")
   {
    alert("Please enter title")
	theForm.title.focus();
	return false;
   }
   if(theForm.address.value == "")
   {
    alert("Please enter address")
	theForm.address.focus();
	return false;
   } 
   if(theForm.location.value == "")
   {
    alert("Please enter Location")
	theForm.location.focus();
	return false;
   } 
   if(theForm.area.value !="")
   {
   if(!isNumeric(theForm.area.value))
   {
    alert("Please Enter Area Only In Numeric Format")
	theForm.area.focus();
	return false;
   }
   if(theForm.plotunit.value=="")
   {
    alert("Please select unit of Area")
	theForm.plotunit.focus();
	return false;
   }
   }
   if(theForm.price.value !="")
   {
   if(!isNumeric(theForm.price.value))
   {
    alert("Please Enter Price Only In Numeric Format")
	theForm.price.focus();
	return false;
   }}
   if(theForm.total.value !="")
   {
    if(!isNumeric(theForm.total.value))
   {
    alert("Please Enter total Price Only In Numeric Format")
	theForm.total.focus();
	return false;
   }
   }
   else
   {
   var v= theForm.area.value;
   var vpri=theForm.price.value;
   var res=parseInt(v*vpri);
   theForm.total.value=res;
   
	}
   if(theForm.file.value != "")
   {
     var x=theForm.file.value;
		var len=x.length;
		var pos=x.indexOf('.');
		var pext=x.substr(pos+1,3);
				
		if(pext=="jpg" ||  pext=="JPG" || pext=="gif" || pext=="GIF" || pext=="png" || pext=="PNG")
		{
		
		}else
		{
		  alert("Image format is not supported.Please enter file only in Jpeg/Gif/Png formate")
			theForm.file.focus();
			return false;
		}

    
   }
     return true;
}
function myprice()
{
if(document.addproperty.area.value=="")
{
alert("Please enter total area") 
document.addproperty.area.focus();
return;
}
if(!isNumeric(document.addproperty.area.value))
{
alert("Please enter total area in Numeric format") 
document.addproperty.area.focus();
return;
}
if(document.addproperty.price.value=="")
{
alert("Please enter price per Unit") 
document.addproperty.price.focus();
return;
}
if(!isNumeric(document.addproperty.price.value))
{
alert("Please enter price per Unit in Numeric format") 
document.addproperty.price.focus();
return;
}

var v=document.addproperty.area.value;
var vpri=document.addproperty.price.value;
var res=parseInt(v*vpri);
document.addproperty.total.value=res;
document.addproperty.total.style.display='';
}
function myprice1()
{
if(document.editproperty.area.value=="")
{
alert("Please enter total area") 
document.editproperty.area.focus();
return;
}
if(!isNumeric(document.editproperty.area.value))
{
alert("Please enter total area in Numeric format") 
document.editproperty.area.focus();
return;
}
if(document.editproperty.price.value=="")
{
alert("Please enter price per Unit") 
document.editproperty.price.focus();
return;
}
if(!isNumeric(document.editproperty.price.value))
{
alert("Please enter price per Unit in Numeric format") 
document.editproperty.price.focus();
return;
}
var v=document.editproperty.area.value;
var vpri=document.editproperty.price.value;
var res=parseInt(v*vpri);

document.editproperty.total.value=res;

document.editproperty.total.style.display='';
}
function banner_validate(theForm)
{
    if(theForm.title.value == "")
   {
    alert("Please enter title")
	theForm.title.focus();
	return false;
   }
   if(theForm.url.value == "")
   {
    alert("Please enter URL")
	theForm.url.focus();
	return false;
   }
   /*
  if(theForm.file.value == "")
   {
    alert("Please enter Banner Image")
	theForm.file.focus();
	return false;
   }
   */
     return true;
}
// validattion for about us 
function about_validate(theForm)
{
    if(theForm.title.value == "")
   {
    alert("Please enter title")
	theForm.title.focus();
	return false;
   }
   if(theForm.short_desc.value == "")
   {
    alert("Please enter short description")
	theForm.short_desc.focus();
	return false;
   }
   if(theForm.long_desc.value == "")
   {
    alert("Please enter full description")
	theForm.long_desc.focus();
	return false;
   }
     return true;
}

function currency_validate(theForm)
{
   if(theForm.title.value == "")
   {
    alert("Please enter currency title")
	theForm.title.focus();
	return false;
   }
   if(theForm.code.value == "")
   {
    alert("Please enter currency code")
	theForm.code.focus();
	return false;
   }
   if(theForm.cvalue.value == "")
   {
    alert("Please enter currency value")
	theForm.cvalue.focus();
	return false;
   }
     return true;
}
//validation for language
function lang_validate(theForm)
{
   if(theForm.name.value == "")
   {
    alert("Please enter language title")
	theForm.name.focus();
	return false;
   }
   if(theForm.code.value == "")
   {
    alert("Please enter language code")
	theForm.code.focus();
	return false;
   }
     return true;
} 
function member_validate(theForm)
{
  if(theForm.email.value == "")
	   {
		alert("Please enter member's Email")
		theForm.email.focus();
		return false;
	   }
		if(!isEmailValid(theForm.email.value))
	   {
		alert("Please enter valid Email ID")
		theForm.email.focus();
		return false;
	   }
     
	   if(theForm.firstname.value == "")
	   {
		alert("Please enter member's first name")
		theForm.firstname.focus();
		return false;
	   }
	    if(theForm.lastname.value == "")
	   {
		alert("Please enter member's last name")
		theForm.lastname.focus();
		return false;
	   }
	   
	if (theForm.mobile.value=="")
		  {
			alert("Please Enter Mobile No.")
			theForm.mobile.focus();
			return false;			
		  }
 
		
    
     return true;
} 

/*
function selectAll()
 { 
 	if (document.frmList.ID == null)
 	{
    	return ;
    }
    if (document.frmList.ID[0] == null)
    {
       document.frmList.ID.checked=true;
       SelectDeselectRow(document.frmList.ID.value,true)
    }
    for(i=0;i<document.frmList.ID.length;i++)
    {
       document.frmList.ID[i].checked=true;
       SelectDeselectRow(document.frmList.ID[i].value,true)
    }
}
            	
 function deselectAll()
  {
    if (document.frmList.ID == null)
    {
     	return ;
    }
	if (document.frmList.ID[0] == null)
	{
  	  document.frmList.ID.checked=false;
      SelectDeselectRow(document.frmList.ID.value,false , '#ffffff','#ffffff')
	}
    for(i=0;i<document.frmList.ID.length;i++)
    {
      document.frmList.ID[i].checked=false;
      SelectDeselectRow(document.frmList.ID[i].value,false,'#ffffff','#ffffff')
    }
 }

function SelectUnselectAll(PresentState)
	{
 		if (PresentState)
     		{
      			selectAll();
       		}
   		else
       		{
       			deselectAll();
       		}
   	}
            	

function SelectDeselectRow(RowID,CheckBoxValue ,tempcolor, bgcolor)
				{
					if(CheckBoxValue)
					{
					}
					else
					{
						document.frmList.SelectUnselect.checked=false;
					}
				}
			*/	
function check_transfer()
				{
				 var  selected = false; 
				 var len = document.frmList.ID.length;
				 for(var i = 0; i < len; i++)
				 {
				   if(document.frmList.ID[i].checked == true)
				   selected = true; 
				 }
					if(selected == false)
					{
					  alert("Please select a customer to transfer")
                      return false;  
					}
                    else
					{
					  var con = window.confirm("Are you sure to transfer selected customer")
					  if(con)
					  {
					   return true;
					  }
					  return false;
					}
				}
function validate_delete(theForm)
{
	var con = window.confirm("Are you  Sure to transfer customers");
	if(con)
		 return true;
	else
		return false;  
}

function showState(theform)
{
alert("hello"+theform);
	for(i = 0 ; i < theform.country.options.length ; i++ )
	 {
		
		eval("state" +theform.country.options[i].value+".style.display='none'")
	 }
	eval("state" +theform.country.options[theform.country.selectedIndex].value+".style.display=''")
}


								
 function showCity()
  {
	document.getElementById("otherCity").style.display='none';
	var i; 
	cctt= "city" ;
	for(i = 0 ; i < document.addproperty.state.options.length ; i++ )
	{ 
	  ii=document.addproperty.state.options[i].value;
	  branchcity= cctt+ii;
	 
	  if(branchcity!="city0")
	  {
	   document.getElementById(eval("City"+ii)).style.display='none';
	   }
		
	}
	 iid=document.addproperty.state.options[document.addproperty.state.selectedIndex].value;
	 
	  branchcityd= cctt+iid;
	    if(branchcityd!="city0")
	  {
	 document.getElementById(branchcityd).style.display='';
	// document.getElementById("cityheading").style.display='';
	 } //else {
	     //document.getElementById("cityheading").style.display='none';
	 //  }
	 
   }
   
   function showCityEdit()
  {
	document.getElementById("otherCity").style.display='none';
	var i; 
	cctt= "city" ;
	for(i = 0 ; i < document.editproperty.state.options.length ; i++ )
	{ 
	  ii=document.editproperty.state.options[i].value;
	  branchcity= cctt+ii;
	 
	  if(branchcity!="city0")
	  {
	   document.getElementById(branchcity).style.display='none';
	   }
		
	}
	
	 iid=document.editproperty.state.options[document.editproperty.state.selectedIndex].value;
	 
	  branchcityd= cctt+iid;
	    if(branchcityd!="city0")
	  {
	 document.getElementById(branchcityd).style.display='';
	
	 } else {
	     document.getElementById("cityheading").style.display='none';
	   }
	 
   }
   
   function addOthrCity(stid)
   {
     cctt= "city"; 
	 city= cctt+stid;
     document.getElementById(city).style.display='none';
	 document.getElementById("otherCity").style.display='';
	 
   }
	function divcity()
	{
 		var val = document.getElementById("admin_groups_id").value;
		 if(val==3)
		{
			mycity.style.display='';
		}
		else
		{
			mycity.style.display='none';
		} 
	}
	</script>