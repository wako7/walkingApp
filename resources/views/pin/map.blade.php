
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Pushpin Add Metadata</title>
<style>html,body{height:100%;}body{padding:0;margin:0;background:#333;}h1{padding:0;margin:0;font-size:50%;color:white;}p{margin:0}button{width:60px;height:60px;background-color: #0B6125;color:white;}#inputForm {position:absolute;top:200px;left:250px;padding:10px;background-color:white;border:1px solid #000;border-radius:10px;}</style>
</head>
<body>


<!-- MAP[START] -->

<div id="myMap" style="width:100%;height:98%;"></div>
    
<form id="form" action="add" method="post" >
    {{ csrf_field() }}
    <div id="inputForm" style="display:none;">
        
        {{-- <p id="latwrite">
            <input name="latitude"/>
        </p>
        <p id="lonwrite">
            <input name="longitude"/>
        </p> --}}
        <p>
            <input id="latwrite" name="latitude" value=""/>
        </p>
        <p>
            <input id="lonwrite" name="longitude" value=""/>
        </p>
        <p>
            <input id="titleTbx" type="text" name="title" />
        </p>
        <p>
            <input id="descriptionTbx" type="text" name="content" />
        </p>
        <p>
            <input id="submit-button" type="button" value="Save">
        </p>

        {{-- <table>
            <tr><td colspan="2"></td></tr>
            <tr><td>Title</td><td><input id="titleTbx" type="text" name="title" /></td></tr>
            <tr><td>Description</td><td><input id="descriptionTbx" type="text" name="content" /></td></tr>
            <tr><td colspan="2"><input type="submit" value="Save" onclick="saveData()" style="float:right;"/></td></tr>
        </table>         --}}
    </div>
</form>
<!-- MAP[END] -->


<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AhbZO9J2FSCJhMML4v4PSiwVRcxOnFJg29zOgPZn9MNRsvwKKnFZyDhZZg7J9Cyy' async defer></script>

<script>
    let map, infobox, currentPushpin;
    function GetMap() {
        map = new Microsoft.Maps.Map('#myMap', {});
        //Add a click event to the map.
        Microsoft.Maps.Events.addHandler(map, 'click', mapClicked);
        //Create an infobox, but hide it. We can reuse it for each pushpin.
        infobox = new Microsoft.Maps.Infobox(map.getCenter(), { visible: false });
        infobox.setMap(map);
    }

    function mapClicked(e) {
        //Create a pushpin.
        currentPushpin = new Microsoft.Maps.Pushpin(e.location); 

        let latitude = currentPushpin.geometry.y;
        let longitude = currentPushpin.geometry.x;

        document.getElementById('latwrite').value = latitude;
        document.getElementById('lonwrite').value = longitude;

        

        //Add a click event to the pushpin.
        Microsoft.Maps.Events.addHandler(currentPushpin, 'click', pushpinClicked);
        //Add the pushpin to the map.
        map.entities.push(currentPushpin);
        //Open up an input form here the user can enter in details for pushpin.
        document.getElementById('inputForm').style.display = '';
    }

    // function saveData() {
        
    //     //Get the data from form and add it to the pushpin
    //     currentPushpin.metadata = {
    //         title: document.getElementById('titleTbx').value,
    //         description: document.getElementById('descriptionTbx').value            
    //     };
        
    //     //Optionally save this data somewhere (like a database or local storage).   
    //     localStorage.setItem(document.getElementById('titleTbx').value, document.getElementById('descriptionTbx').value);

    //     //Clear the fields in the form and then hide the form.
    //     document.getElementById('titleTbx').value = '';
    //     document.getElementById('descriptionTbx').value = '';
    //     document.getElementById('inputForm').style.display = 'none';
    // }

    /*
      pinクリック時にポップアップ表示
    */
    function pushpinClicked(e) {
        console.log("クリックされた");
        console.log(e.lacation);
        if (e.target.metadata) {
            infobox.setOptions({
                location: e.target.getLocation(),
                title: e.target.metadata.title,
                description: e.target.metadata.description,
                visible: true                
            }); 
        }       
    }

    /*
      formのデータをPOSTする
    */
    const form = document.getElementById("form")
    
    const submitButton = document.getElementById("submit-button")

    submitButton.onclick = () => {
    const formData = new FormData(form)    
    const action = form.getAttribute("action")
    console.log(action);
    const options = {
        method: 'POST',
        body: formData,
    }
    fetch(action, options).then((e) => {
        if(e.status === 200) {
        alert("保存しました。");
        document.getElementById('titleTbx').value = '';
        document.getElementById('descriptionTbx').value = '';
        document.getElementById('inputForm').style.display = 'none';
        return
        }
        alert("保存できませんでした。")
    })
    }    
</script>



<!--DB情報の取得(ajax）-->

<script>
    let pinD = [];
    
    $(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            type: "POST",
            url: "/show",         
            dataType: "json",
          success: function(data){
            pinD = data;
            console.log(pinD);
            // setPins(pinD);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown){
            alert('Error : ' + errorThrown);
            
          }
        });
      });

    //pin生成
    function setPins(pinData){
        console.log(pinData);
    
    };
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</body>
</html>