// Get the file input element
const fileInput = document.getElementById('file');
console.log(`The PDF file page count has started.`);
// Add an event listener to the file input element
fileInput.addEventListener('change', (e) => {
  // Get the selected file
  const file = e.target.files[0];

  // Check if the file is a PDF
  if (file.type === 'application/pdf') {
    // Create a new promise to read the file
    const readFilePromise = new Promise((resolve, reject) => {
      // Create a new file reader
      const fileReader = new FileReader();

      // Add an event listener to the file reader
      fileReader.onload = (event) => {
        // Get the file contents
        const fileContents = event.target.result;

        // Create a new PDF.js document
        const pdfDocument = pdfjsLib.getDocument({data: fileContents});

        // Get the number of pages in the PDF document
        pdfDocument.promise.then((pdf) => {
          const numPages = pdf.numPages;
          resolve(numPages);
        });
      };

      // Read the file as an array buffer
      fileReader.readAsArrayBuffer(file);
    });

    // Wait for the promise to resolve
    readFilePromise.then((numPages) => {
      console.log(`The PDF file has ${numPages} pages.`);
      document.getElementById('page-count').innerHTML = `Page Count: ${numPages}`;
    });
  } else {
    console.log('Please select a PDF file.');
    document.getElementById('page-count').innerHTML = 'Please select a PDF file.';
  }
});