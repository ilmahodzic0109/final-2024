var Constants = {
  get_api_base_url: function () {
    if(location.hostname == 'localhost'){
      return "http://localhost:80/final-2024/backend/rest";
    } else {
      return "";
    }
  }
};