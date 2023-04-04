<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Login</h3>
        </div>
        <div class="card-body">
          <?= $this->Flash->render() ?>
          <?= $this->Form->create(null, ['class' => 'needs-validation', 'novalidate']) ?>
          <div class="form-group">
            <?= $this->Form->control('email', ['required' => true, 'class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control('password', ['required' => true, 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) ?>
          </div>
          <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary btn-block', 'onclick' => 'return validateForm(event);']) ?>
          <?= $this->Form->end() ?>
          <div class="text-center">
            <?= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'mt-3' ]) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<script>
    function validateForm(event) {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (email == "") {
        alert("Email must be filled out");
        if(event.type === "submit") {
        event.preventDefault(); // Prevent the form from submitting
        }
        return false;
    }

    // Add a condition to check for the "@" symbol in the email
    if (email.indexOf("@") == -1) {
        alert("Email must contain the '@' symbol");
        if(event.type === "submit") {
        event.preventDefault(); // Prevent the form from submitting
        }
        return false;
    }
    
    if (password == "") {
        alert("Password must be filled out");
        if(event.type === "submit") {
        event.preventDefault(); // Prevent the form from submitting
        }
        return false;
    }
    
    // If all validation is passed, allow the form to submit
    return true;
    }

    // Add event listeners to the input fields that listen for the "blur" event
    document.getElementById("email").addEventListener("blur", validateForm) =function() {
    var self = this;
    setTimeout(function() { self.focus(); }, 2);
    }
    document.getElementById("password").addEventListener("blur", validateForm) =function() {
    var self = this;
    setTimeout(function() { self.focus(); }, 2);
    }
    document.getElementById("myForm").addEventListener("submit", validateForm);

    
</script>
