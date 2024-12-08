<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF.js Example to count number of pages in pdf document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
</head>
<body>
  <div class="container">
    <h1 class="text-center">Counting PDF Document Pages in PDF.js</h1>
    <div>
        <label for="file">Upload PDF file:</label> 
        <input type="file" name="" id="file" accept=".pdf" required class="form-control">
    </div>
    <div class="text-primary" id="info">

    </div>
 </div>
 </body>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    let pdf = document.getElementById('file')
    
    pdf.onchange = function(event){
        var file = event.target.files[0];
        console.log(file);

        var filereader = new FileReader()
            
            filereader.onload = function(){
                var typedarray = new Uint8Array(this.result)

                const task = pdfjsLib.getDocument(typedarray)

                task.promise.then((pdf) =>{
                    console.log(pdf.numPages)
                    

                })
            }
            filereader.readAsArrayBuffer(file)
            
        
        
    }
</script>
 </html>