<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        //https://jsonplaceholder.typicode.com/users
        let output = ''

        async function getDataFromApi(){
            const url ="https://jsonplaceholder.typicode.com/users"
            const res = await fetch(url)
            const json = await res.json()
            console.log(json)
            json.forEach(item => {
                output+="<li>"+item.name+" <br> Address :"+item.address["street"]+"</li>"
                
            }); 

            list.innerHTML = output
        }
        getDataFromApi()
    </script>
</head>

<body>
    <ol id="list">

    </ol>

</body>

</html>