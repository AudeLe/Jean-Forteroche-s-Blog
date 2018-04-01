var connection = {

    init: function(){
        connectionBtn = document.getElementById("connection");
        connectionForm = document.getElementById("connectionForm");
    },

    activedConnectionForm: function(){
        connection.init();

        connectionBtn.addEventListener("click", function(){
            connectionForm.style.display = "block";
        });
    }
}
connection.activedConnectionForm();