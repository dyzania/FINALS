document.getElementById('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
  
    // Get user input
    const role = document.getElementById('role').value;
    const password = document.getElementById('password').value;
  
    // Define valid credentials
    const validCredentials = {
      'Department Head': 'SiEsD3ptH34d',
      'Faculty': 'SiEsF4cu1ty',
      'Student Officer': '#CCSOAko',
      'Student': '3SapatNa!'
    };
  
    // Check if the role exists in the valid credentials
    if (!validCredentials.hasOwnProperty(role)) {
      console.error('Invalid Role Selected');
      document.getElementById('output').innerHTML = '<p style="color: red;">Error: Invalid Role Selected</p>';
      return;
    }
  
    // Check password validity
    if (password === validCredentials[role]) {
      switch (role) {
        case 'Department Head':
          console.log('Access Granted: Welcome Department Head!');
          document.getElementById('output').innerHTML = '<p style="color: green;">Access Granted: Welcome Department Head!</p>';
          break;
        case 'Faculty':
          console.warn('Access Granted: Faculty Login Successful.');
          document.getElementById('output').innerHTML = '<p style="color: orange;">Access Granted: Faculty Login Successful.</p>';
          break;
        case 'Student Officer':
          console.log('Access Granted: Student Officer Authenticated.');
          document.getElementById('output').innerHTML = '<p style="color: blue;">Access Granted: Student Officer Authenticated.</p>';
          break;
        case 'Student':
          console.log('Access Granted: Student Login Confirmed.');
          document.getElementById('output').innerHTML = '<p style="color: purple;">Access Granted: Student Login Confirmed.</p>';
          break;
        default:
          console.error('Unexpected Role Detected');
          document.getElementById('output').innerHTML = '<p style="color: red;">Error: Unexpected Role Detected</p>';
      }
    } else {
      console.error('Authentication Failed: Incorrect Password');
      document.getElementById('output').innerHTML = '<p style="color: red;">Error: Authentication Failed - Incorrect Password</p>';
    }
  });