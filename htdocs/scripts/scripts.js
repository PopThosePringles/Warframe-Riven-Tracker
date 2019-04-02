let zoom_stage = localStorage.getItem("zoom_riven_stage") || 0;
let zoom_class = localStorage.getItem("zoom_riven_class") || "";

$(() => {

	let $content = $("#content");

	if(parseInt(zoom_stage, 10) > 0){
		$content.addClass(zoom_class);
	}

	$("#zoom-rivens").on("click", () => {

		switch(parseInt(zoom_stage, 10)){

			case 0:

				$content.removeClass(zoom_class);
				zoom_class = "zoom-rivens-1";
				zoom_stage = 1;

				break;

			case 1:

				$content.removeClass(zoom_class);
				zoom_class = "zoom-rivens-2";
				zoom_stage = 2;

				break;

			case 2:

				$content.removeClass(zoom_class);
				zoom_class = "zoom-rivens-3";
				zoom_stage = 3;

				break;

			case 3:

				$content.removeClass(zoom_class);
				zoom_class = "zoom-rivens-4";
				zoom_stage = 4;

				break;

			case 4:

				$content.removeClass(zoom_class);
				zoom_class = "zoom-rivens-5";
				zoom_stage = 5;

				break;

			case 5:

				$content.removeClass(zoom_class);
				zoom_class = "";
				zoom_stage = 0;

				break;

		}

		$content.addClass(zoom_class);

		localStorage.setItem("zoom_riven_stage", zoom_stage);
		localStorage.setItem("zoom_riven_class", zoom_class);

		return false;

	});

});