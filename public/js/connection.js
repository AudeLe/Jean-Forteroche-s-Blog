var connection = {

    init: function(){
        registrationBtn = document.getElementById("registration");
        registrationForm = document.getElementById("registrationForm");
        connectionBtn = document.getElementById("connection");
        connectionForm = document.getElementById("connectionForm");
    },

    activatedRegistrationForm: function(){
        connection.init();

        registrationBtn.addEventListener("click", function(){
            registrationForm.style.display = "block";
        });
    },

    activatedConnectionForm: function(){
        connection.init();

        connectionBtn.addEventListener("click", function(){
            connectionForm.style.display = "block";
        });
    }

}

connection.activatedRegistrationForm();
connection.activatedConnectionForm();