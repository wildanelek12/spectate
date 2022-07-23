
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
      <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-wcgkmI0RJMTpcpE1"></script>
      <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    </head>
   
    <body>
      <button id="pay-button">Pay!</button>
   
      <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          console.log('41c6acdd-8d38-4e7c-929b-7c36ae8ebeec');
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('84ffcd0d-5e20-4e6c-aea1-5d5b88c68dc3');
          // customer will be redirected after completing payment pop-up
        });
      </script>
    </body>
  </html>