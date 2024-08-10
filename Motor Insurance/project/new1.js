$(document).ready(function(){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 400) {
            $(".header").addClass("scrolled");
        } else {
            $(".header").removeClass("scrolled");
        }
    });

    $('.menu').click(function(){
        $(".header").toggleClass("header2");
        $('nav ul').slideToggle();
    });

    $('.yes').click(function(event){
        event.preventDefault(); // Prevent the default link behavior
    
        var hasLicense = confirm("\nDo you have a license?");
        if (hasLicense) {
            var licenseNumber = prompt("Please enter your license number:");
            var licensePattern = /^[A-Z]{2}[0-9]{2} [0-9]{11}$/;
    
            // Check if license number matches the pattern
            if (licenseNumber !== null && licenseNumber.trim() !== "" && licensePattern.test(licenseNumber)) {
                console.log("License number entered: " + licenseNumber);
                
                // AJAX request to check if the license number exists in the database
                $.ajax({
                    url: 'check_license.php', // The URL of the server-side script
                    type: 'POST',
                    data: { licenseNumber: licenseNumber },
                    dataType: 'json',
                    success: function(response) {
                        // Handle the response from the server
                        if (response.exists) {
                            alert("\n\t     License number already exists .");
                        } else {
    
                            // Create and submit the form with the license number
                            var form = $('<form>', {
                                action: '../otp1/index1.php',
                                method: 'POST'
                            }).append($('<input>', {
                                type: 'hidden',
                                name: 'licenseNumber',
                                value: licenseNumber
                            }));
    
                            $('body').append(form);
                            form.submit();
                        }
                    },
                    error: function() {
                        console.log("Error checking license number");
                        alert("\n\tThere was an error checking the license number.");
                    }
                });
            } else {
                console.log("Invalid license number");
                alert("\n\tInvalid license number\n\n\t License number must be in the format 'XX00 00000000000'.");
            }
        } else {
            console.log("User does not have a license");
        }
    });
    
});

