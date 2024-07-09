var CustomersService = {
    reload_customer_datatable: function () {
        Utils.get_datatable(
          "tbl_patients",
          Constants.get_api_base_url() , // get_patients.php
          [
            { data: "action" },
            { data: "first_name" },
            { data: "last_name" },
            { data: "birth_date" },
           
          ]
        );
      },
      open_edit_patient_modal: function (patient_id) {
        RestClient.get("patients/" + patient_id, function (data) {
          $("#add-patient-modal").modal("toggle");
          $("#add-patient-form input[name='id']").val(data.id);
          $("#add-patient-form input[name='first_name']").val(data.first_name);
          $("#add-patient-form input[name='last_name']").val(data.last_name);
          $("#add-patient-form input[name='email']").val(data.email);
          $("#add-patient-form input[name='created_at']").val(data.created_at);
        });
      }
}