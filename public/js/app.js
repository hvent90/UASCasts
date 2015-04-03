var putSessionVariable = function(keyData, valueData, callback) {
	var formData = {
		key: keyData,
		value: valueData,
		_token: $('meta[name="csrf-token"]').attr('content')
	};

	$.ajax({
		type: "POST",
		url: '/session',
		data: formData,
		async: false,
		success: function(data, textStatus, jqXHR) {
			callback;
		},
		error: function(data){
			return data;
	    }
	});
};
//# sourceMappingURL=app.js.map