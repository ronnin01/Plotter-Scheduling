$(document).ready(function(){

    const __icon = {
        erro_icon: '<i class="bi bi-exclamation-diamond"></i>',
        success_icon: '<i class="bi bi-check2-circle"></i>',
        spinner: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    }

    function trigger_toast(__toast){
        const toastLiveExample = document.getElementById(__toast);
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
        toastBootstrap.show();
    }

    function trigger_toast_message(__message, __icon, __backgrounColor, __textColor){
        return `
        <div id="trigger-toast" class="toast rounded-0 align-items-center ${__backgrounColor}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body ${__textColor}">
                    ${__icon}
                    ${__message}
                </div>
                <button type="button" class="btn-close me-2 m-auto shadow" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        `;
    }

    var __department;
    var __semester;
    var __school_year;

    function section_timetable(department, semester, school_year, section){
        $.ajax({
            type: "POST",
            url: "../data/data.section_timetable.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                section: section,
                submit: "submit"
            },
            success: function (response) {
                $("#section-timetable").html(response);
            }
        });
    }

    function teacher_timetable(department, semester, school_year, teacher){
        $.ajax({
            type: "POST",
            url: "../data/data.teacher_timetable.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                teacher: teacher,
                submit: "submit"
            },
            success: function (response) {
                $("#teacher-timetable").html(response);
            }
        });
    }

    function room_timetable(department, semester, school_year, room){
        $.ajax({
            type: "POST",
            url: "../data/data.room_timetable.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                room: room,
                submit: "submit"
            },
            success: function (response) {
                $("#room-timetable").html(response);
            }
        });
    }

    // LOGIN IN SUBMIT FUNCTION
    $(document).on("submit", "#login-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById('login-form');
        const formData = new FormData(form);
        
        // DATA TO BE SEND IN AJAX
        const username = formData.get('username');
        const password = formData.get('password');

        // AJAX DATA SEND
        $.ajax({
            type: "POST",
            url: "data/data.signin.php",
            data: {
                username: username,
                password: password,
                form_login: username+password //FORM_LOGIN TO BE CHECKED THAT THE BUTTON SUBMIT FORM IS TRIGGERED
            },
            beforeSend: ()=>{
                $("#form-login-btn").html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Login
                `);
            },
            success: function(data){
                $("#form-login-btn").html(`Login`);

                // CHECK LOGIN CREDENTIALS
                if(data == "error_username_email"){

                    $("#login-message").html(trigger_toast_message("Please check Username.", __icon.erro_icon,"bg-ternary", "text-light"));
                    trigger_toast("trigger-toast");

                }else if(data == "error_password"){

                    $("#login-message").html(trigger_toast_message("Please check Password.",  __icon.erro_icon,"bg-ternary", "text-light"));
                    trigger_toast("trigger-toast");

                }else{
                    if(data == "Admin"){
                        window.location.href = "/scheduling/admin/plot.php";
                    }else{
                        alert(data)
                    }
                }
            }
        })
    });

    // RETRIEVE TIMETABLE   
    function retrieve_timetable(){
        $.ajax({
            type: "GET",
            url: "../data/data.timetable.php",
            beforeSend: function(){
                $("#section-timetable").html(`
                    <div class="text-center">
                        ${__icon.spinner}
                    </div>
                `)
                $("#teacher-timetable").html(`
                    <div class="text-center">
                        ${__icon.spinner}
                    </div>
                `)
                $("#room-timetable").html(`
                    <div class="text-center">
                        ${__icon.spinner}
                    </div>
                `)
                $("#print-section-timetable").html(`
                    <div class="text-center">
                        ${__icon.spinner}
                    </div>
                `)
            },
            success: function (response) {
                $("#section-timetable").html(response)
                $("#teacher-timetable").html(response)
                $("#room-timetable").html(response)
            }
        });
    }
    retrieve_timetable();

    // RETRIEVE DEPARTMENT
    function retrieve_department(){
        $.ajax({
            type: "GET",
            url: "../data/data.retrieve_department.php",
            success: function (response) {
                $("#select-department").html(response);
                $("#select-department-subject").html(response);
                $("#section-select-department").html(response);
                $("#room-select-department").html(response);
                $("#select-section-department").html(response);
                $("#print-select-department").html(response);
            }
        });
    }
    retrieve_department();

    // ADD DEPARTMENT FUNCTION
    $(document).on("submit", "#add-department-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-department-form");
        const formData = new FormData(form);

        // VARIABLES TO BE SEND 
        const department_code = formData.get("department_code");
        const department_title = formData.get("department_title");
        const department_designation = formData.get("department_designation");

        $.ajax({
            type: "POST",
            url: "../data/data.add_department.php",
            data: {
                department_code: department_code.toUpperCase(),
                department_title: department_title,
                department_designation: department_designation,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-department-btn").html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Add Department
                `);
            },
            success: function (response) {
                $("#add-department-btn").html(`
                    Add Department
                `);

                if(response == "dept-title-error"){

                    $("#alert-messages").html(trigger_toast_message("Department title has been used.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else if(response == "dept-designation-error"){

                    $("#alert-messages").html(trigger_toast_message("Department Designation has been used.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else if(response == "dept-code-error"){

                    $("#alert-messages").html(trigger_toast_message("Department code has been used.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else if(response == 0){

                    $("#alert-messages").html(trigger_toast_message("Unable to add Department.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else {

                    $("#alert-messages").html(trigger_toast_message("Department has been added.", __icon.erro_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");

                }
            }
        });
    })

    // RETRIEVE ACADEMIC YEAR FUNCTION
    function retrieve_academic_year(){
        $.ajax({
            type: "GET",
            url: "../data/data.retrieve_academic_year.php",
            success: function (response) {
                $("#select-ay").html(response);
                $("#select-ay-subject").html(response);
                $("#select-section-ay").html(response);
                $("#print-select-school-year").html(response);
            }
        });
    }
    retrieve_academic_year();

    // ADD ACADEMIC YEAR FUNCTION
    $(document).on("submit", "#add-academic-year-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-academic-year-form");
        const formData = new FormData(form);

        // VARIABLES TO BE SEND IN AJAX
        const academic_year = formData.get("academic_year");
        const semester = formData.get("select_semester");
        
        $.ajax({
            type: "POST",
            url: "../data/data.add_academic_year.php",
            data: {
                academic_year: academic_year,
                semester: semester,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-academic-year-btn").html(`
                    ${__icon.spinner}
                    Add A.Y.
                `);
            },
            success: function (response) {
                $("#add-academic-year-btn").html(`
                    Add A.Y.
                `);

                if(response == 'ay_added'){

                    $("#alert-messages").html(trigger_toast_message("Academic Year has been used.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else if(response == 0){

                    $("#alert-messages").html(trigger_toast_message("Unable to add Academic year.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else{

                    $("#alert-messages").html(trigger_toast_message("Academic year has been added.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");

                }
            }
        });
    });

    // ADD TEACHER FUNCTION
    $(document).on("submit", "#add-teacher-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-teacher-form");
        const formData = new FormData(form);
        
        // DATA VARIABLES TO BE SEND IN AJAX
        const firstname = formData.get("firstname");
        const lastname = formData.get("lastname");
        const middlename = formData.get("middlename");
        const id_number = formData.get("id_number");
        const bachelor = formData.get("_bachelor");
        const master = formData.get("_master");
        const doctor = formData.get("_doctor");
        const special = formData.get("_special");
        const major = formData.get("_major");
        const minor = formData.get("_minor");
        const designation = formData.get("_designation");
        const status = formData.get("status");
        const research = formData.get("research");
        const production = formData.get("production");
        const extension = formData.get("extension");
        const others = formData.get("extension");

        $.ajax({
            type: "POST",
            url: "../data/data.add_teacher.php",
            data: {
                firstname: firstname,
                lastname: lastname,
                middlename: middlename,
                id_number: id_number,
                bachelor: bachelor,
                master: master,
                doctor: doctor,
                special: special,
                major: major,
                minor: minor,
                designation: designation,
                status: status,
                research: research,
                production: production,
                extension: extension,
                others: others,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-teacher-btn").html(__icon.spinner);
            }, 
            success: function (response) {
                $("#add-teacher-btn").html("Add Teacher");

                console.log(response)

                if(response == "id_number_error"){

                    $("#alert-messages").html(trigger_toast_message("ID Number is used.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else if(response == 1){

                    $("#alert-messages").html(trigger_toast_message("Teacher has been added.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");

                }else{

                    $("#alert-messages").html(trigger_toast_message("Unable to add Teacher.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }
            }
        });

    });

    // ADD SECTION FUNCTION
    $(document).on("submit", "#add-section-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-section-form");
        const formData = new FormData(form);

        const section_name = formData.get("section_name");
        const section_program = formData.get("section_program");
        const section_department = formData.get("section_department");
        const section_major = formData.get("section_major");

        $.ajax({
            type: "POST",
            url: "../data/data.add_section.php",
            data: {
                section_name: section_name.toUpperCase(),
                section_program: section_program,
                section_department: section_department,
                section_major: section_major,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-section-btn").html(__icon.spinner);
            },
            success: function (response) {
                $("#add-section-btn").html("Add Section");

                if(response == "section_error"){

                    $("#alert-messages").html(trigger_toast_message("Section is already added.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }else if(response == 1){

                    $("#alert-messages").html(trigger_toast_message("Section has been added.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");

                }else{

                    $("#alert-messages").html(trigger_toast_message("Unable to add Section.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");

                }
            }
        });
    });

    // ADD ROOM FUNCTION
    $(document).on("submit", "#add-room-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-room-form");
        const formData = new FormData(form);

        // DATA VARIABLES TO BE SEND IN AJAX
        const room_department = formData.get("room_department");
        const room_name = formData.get("room_name");
        const room_building = formData.get("room_building");
        const room_capacity = formData.get("room_capacity");
        const room_type = formData.get("room_type");

        $.ajax({
            type: "POST",
            url: "../data/data.add_room.php",
            data: {
                room_department: room_department,
                room_name: room_name,
                room_building: room_building,
                room_capacity: room_capacity,
                room_type: room_type,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-room-btn").html(__icon.spinner);
            },
            success: function (response) {
                $("#add-room-btn").html("Add Room");

                if(response == "room_already_added"){
                    $("#alert-messages").html(trigger_toast_message("Room is already added.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");
                }else if(response == 1){
                    $("#alert-messages").html(trigger_toast_message("Room is added.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");
                }else{
                    $("#alert-messages").html(trigger_toast_message("Unable to add room.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");
                }
            }
        });
    })

    // ADD SUBJECT FUNCTION
    $(document).on("submit", "#add-subject-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-subject-form");
        const formData = new FormData(form);

        // DATA VARIABLES TO BE SEND IN AJAX
        const subject_name = formData.get("subject_name");
        const subject_title = formData.get("subject_title");
        const subject_unit = formData.get("subject_unit");
        const subject_lecture_hour = formData.get("subject_lecture_hour");
        const subject_laboratory_hour = formData.get("subject_laboratory_hour");

        $.ajax({
            type: "POST",
            url: "../data/data.add_subject.php",
            data: {
                subject_name: subject_name,
                subject_title: subject_title,
                subject_unit: subject_unit,
                subject_lecture_hour: subject_lecture_hour,
                subject_laboratory_hour: subject_laboratory_hour,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-subject-btn").html(__icon.spinner);
            },
            success: function (response) {
                $("#add-subject-btn").html("Add Subject");

                console.log(response);

                if(response == "subject_already_added"){
                    $("#alert-messages").html(trigger_toast_message("Subject is already added.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");
                }else if(response == 1){
                    $("#alert-messages").html(trigger_toast_message("Subject is added.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");
                }else{
                    $("#alert-messages").html(trigger_toast_message("Unable to add subject.", __icon.erro_icon, "bg-ternary", "text-white"));
                    trigger_toast("trigger-toast");
                }
            }
        });
        
    })

    // TEACHER LIST DATATABLE
    if(window.location.pathname == "/scheduling/admin/add_plot.php"){
        $('#datatable-teacher').DataTable();
        $("#datatable-subject").DataTable();
        $("#datatable-section").DataTable();
    }


    // ADD TEACHER PLOT FUNCTION
    $(document).on("submit", "#add-teacher-plot-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-teacher-plot-form");
        const formData = new FormData(form);

        // VARIABLES TO BE SEND IN AJAX
        const department = formData.get("department");
        const semester = formData.get("semester");
        const school_year = formData.get("school_year");
        const teacher_name = new Array();
        $("input:checked").each(function(){
            teacher_name.push($(this).val());
        })
        
        $.ajax({
            type: "POST",
            url: "../data/data.add_teacher_plot.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                teacher_name: teacher_name,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-teacher-plot-btn").html(__icon.spinner);
            },
            success: function (response) {
                $("#add-teacher-plot-btn").html("Add Teacher Plot");

                if(response == 1){
                    $("#alert-messages").html(trigger_toast_message("Teacher is added to plot.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");
                }else{
                    $("#alert-messages").html(trigger_toast_message(response, __icon.erro_icon, "bg-danger", "text-white"));
                    trigger_toast("trigger-toast");
                }
            }
        });

    })

    // THIS FUNCTION HELPS NOT TO DRY YOURSELF RETRIEVE TEACHER FOR SUBJECT PLOT
    function retrieve_teacher_for_subject_plot(department, semester, school_year){
        $.ajax({
            type: "POST",
            url: "../data/data.retrieve_teacher_for_subject_plot.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                submit: "submit"
            },
            success: function(response){
                $("#select-teacher-subject-plot").html(response);
            }
        })
    }

    // SELECT DEPARTMENT CHANGE FOR SUBJECT PLOT
    $(document).on("change", "#select-department-subject", ()=>{
        var department = $("#select-department-subject").val();
        __department = department;
        
        retrieve_teacher_for_subject_plot(department, __semester, __school_year);
    });

    // SELECT SEMESTER CHANGE FOR SUBJECT PLOT
    $(document).on("change", "#select-semester-subject", ()=>{
        var semester = $("#select-semester-subject").val();
        __semester = semester;
        
        retrieve_teacher_for_subject_plot(__department, semester, __school_year);
    });

    // SELECT SCHOOL YEAR CHANGE FOR SUBJECT PLOT
    $(document).on("change", "#select-ay-subject", ()=>{
        var school_year = $("#select-ay-subject").val();
        __school_year = school_year;
        
        retrieve_teacher_for_subject_plot(__department, __semester, school_year);
    });

    // ADD SUBJECT TO PLOT FUNCTION
    $(document).on("submit", "#add-subject-plot-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-subject-plot-form");
        const formData = new FormData(form);

        // VARIABLES TO BE SEND IN AJAX
        const department = formData.get("select_subject_department");
        const semester = formData.get("select_subject_semester");
        const school_year = formData.get("select_subject_school_year");
        const teacher = formData.get("select_subject_teacher");
        const subject = new Array();
        $("#subject_plot:checked").each(function(){
            subject.push($(this).val());
        })

        $.ajax({
            type: "POST",
            url: "../data/data.add_subject_plot.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                teacher: teacher,
                subject: subject,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-subject-plot-btn").html(__icon.spinner);
            },
            success: function(response){
                $("#add-subject-plot-btn").html("Add Subject Plot");

                if(response == 1){
                    $("#alert-messages").html(trigger_toast_message("Subject is added to plot.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");
                }else{
                    $("#alert-messages").html(trigger_toast_message(response, __icon.erro_icon, "bg-danger", "text-white"));
                    trigger_toast("trigger-toast");
                }
            }
        })

    });

    // ADD SECTION TO PLUT FUNCTION
    $(document).on("submit", "#add-section-plot-form", (e)=>{
        e.preventDefault();

        const form = document.getElementById("add-section-plot-form");
        const formData = new FormData(form);

        // VARIABLE DATA TO BE SEND IN AJAX
        const semester = formData.get("select_section_semester");
        const school_year = formData.get("select_section_school_year");
        const section_id = new Array();
        $("#section-plot:checked").each(function(){
            section_id.push($(this).val());
        })

        $.ajax({
            type: "POST",
            url: "../data/data.add_section_plot.php",
            data: {
                semester,
                school_year,
                section_id,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-section-plot-btn").html(__icon.spinner);
            },
            success: function (response) {
                $("#add-section-plot-btn").html("Add Section Plot");

                console.log(response)
            }
        });

    })

    // THIS FUNCTION HELPS NOT TO DRY YOURSELF RETRIEVE TEACHER SECTION FOR PLOT
    function retrieve_teacher_for_plot(department, semester, school_year){
        $.ajax({
            type: "POST",
            url: "../data/data.retrieve_teacher_for_plot.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                submit: "submit"
            },
            success: function (response) {
                $("#select-teacher").html(response);
                $("#select-teacher-timetable").html(response);
                $("#print-select-teacher").html(response);
            }
        });
    }

    function retrieve_section_for_plot(department, semester, school_year){
        $.ajax({
            type: "POST",
            url: "../data/data.retrieve_section_for_plot.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                submit: "submit"
            },
            success: function (response) {
                $("#select-section").html(response);
                $("#print-select-section").html(response);
                $("#select-section-timetable").html(response);
            }
        });
    }

    function retrieve_room_for_plot(department){
        $.ajax({
            type: "POST",
            url: "../data/data.retrieve_room_for_plot.php",
            data: {
                department: department,
                submit: "submit"
            },
            success: function (response) {
                $("#select-room").html(response);
                $("#select-room-timetable").html(response);
                $("#print-select-room").html(response);
            }
        });
    }

    function retrieve_subject_for_teacher_plot(department, semester, school_year, teacher){
        $.ajax({
            type: "POST",
            url: "../data/data.retrieve_subject_for_plot.php",
            data: {
                department: department,
                semester: semester,
                school_year: school_year,
                teacher: teacher,
                submit: "submit"
            },
            success: function (response) {
                $("#select-subject").html(response);
            }
        });
    }

    // SELECT DEPARTMENT FUNCTION FOR PLOT 
    $(document).on("change", "#select-department", ()=>{
        var department = $("#select-department").val();
        __department = department;

        retrieve_teacher_for_plot(department, __semester, __school_year);
        retrieve_section_for_plot(department, __semester, __school_year);
        retrieve_room_for_plot(department);
    });

    // SELECT SEMESTER FUNCTION FOR PLOT
    $(document).on("change", "#select-semester", ()=>{
        var semester = $("#select-semester").val();
        __semester = semester;

        retrieve_teacher_for_plot(__department, semester, __school_year);
        retrieve_section_for_plot(__department, semester, __school_year);
    });

    // SELECT SCHOOL YEAR 
    $(document).on("change", "#select-ay", ()=>{
        var school_year = $("#select-ay").val();
        __school_year = school_year;

        retrieve_teacher_for_plot(__department, __semester, school_year);
        retrieve_section_for_plot(__department, __semester, school_year);
    });

    // SELECT TEACHER 
    $(document).on("change", "#select-teacher", ()=>{
        var teacher = $("#select-teacher").val();

        retrieve_subject_for_teacher_plot(__department, __semester, __school_year, teacher);
    })

    // ADD SCHEDULE FORM PLOT FUNCTION
    $(document).on("submit", "#add-schedule-form-plot", (e)=>{
        e.preventDefault();
        
        const form = document.getElementById("add-schedule-form-plot");
        const formData = new FormData(form);

        // DATA VARIABLES TO BE SEND IN AJAX
        const plot_department = formData.get("plot_department");
        const plot_semester = formData.get("plot_semester");
        const plot_school_year = formData.get("plot_school_year");
        const plot_room = formData.get("plot_room");
        const plot_section = formData.get("plot_section");
        const plot_week_day = formData.get("plot_week_day");
        const plot_teacher = formData.get("plot_teacher");
        const plot_subject = formData.get("plot_subject");
        const plot_start_time_hour = formData.get("plot_start_time_hour");
        const plot_start_time_minute = formData.get("plot_start_time_minute");
        const plot_end_time_hour = formData.get("plot_end_time_hour");
        const plot_end_time_minute = formData.get("plot_end_time_minute");

        if(plot_end_time_hour <= plot_start_time_hour && plot_end_time_minute <= plot_start_time_minute){
            $("#alert-messages").html(trigger_toast_message("Starting time must not be greater to end time.", __icon.erro_icon, "bg-danger", "text-white"));
            trigger_toast("trigger-toast");
            return false
        }

        $.ajax({
            type: "POST",
            url: "../data/data.add_schedule.php",
            data: {
                plot_department: plot_department,
                plot_semester: plot_semester,
                plot_school_year: plot_school_year,
                plot_room: plot_room,
                plot_section: plot_section,
                plot_week_day: plot_week_day,
                plot_teacher: plot_teacher,
                plot_subject: plot_subject,
                plot_start_time_hour: plot_start_time_hour,
                plot_start_time_minute: plot_start_time_minute,
                plot_end_time_hour: plot_end_time_hour,
                plot_end_time_minute: plot_end_time_minute,
                submit: "submit"
            },
            beforeSend: function(){
                $("#add-schedule-btn-plot").html(__icon.spinner);
            },
            success: function (response) {
                $("#add-schedule-btn-plot").html("Add Schedule");

                if(response == 1){
                    $("#alert-messages").html(trigger_toast_message("Schedule has been added.", __icon.success_icon, "bg-success", "text-dark"));
                    trigger_toast("trigger-toast");

                    section_timetable(plot_department, plot_semester, plot_school_year, plot_section);
                    teacher_timetable(plot_department, plot_semester, plot_school_year, plot_teacher);
                    room_timetable(plot_department, plot_semester, plot_school_year, plot_room);
                    
                }else{
                    $("#alert-messages").html(trigger_toast_message(response, __icon.erro_icon, "bg-danger", "text-white"));
                    trigger_toast("trigger-toast");
                }
            }
        });
    });

    // SELECT SECTION TIMETABLE
    $(document).on("change", "#select-section-timetable", ()=>{
        const section = $("#select-section-timetable").val();
        section_timetable(__department, __semester, __school_year, section);
    });
    $(document).on("change", "#select-section", ()=>{
        const section = $("#select-section").val();
        section_timetable(__department, __semester, __school_year, section);
    });

    // SELECT TEACHER TIMETABLE
    $(document).on("change", "#select-teacher-timetable", ()=>{
        const teacher = $("#select-teacher-timetable").val();
        teacher_timetable(__department, __semester, __school_year, teacher);
    });
    $(document).on("change", "#select-teacher", ()=>{
        const teacher = $("#select-teacher").val();
        teacher_timetable(__department, __semester, __school_year, teacher);
    });

    // SELECT ROOM TIMETABLE
    $(document).on("change", "#select-room-timetable", ()=>{
        const room = $("#select-room-timetable").val();
        room_timetable(__department, __semester, __school_year, room);
    });
    $(document).on("change", "#select-room", ()=>{
        const room = $("#select-room").val();
        room_timetable(__department, __semester, __school_year, room);
    });

    // RETRIEVE PRINT TIMETABLE   
    function retrieve_print_timetable(){
        $.ajax({
            type: "GET",
            url: "../data/data.print_timetable.php",
            success: function (response) {
                $("#print-section-timetable").html(response)
                $("#print-teacher-timetable").html(response);
                $("#print-room-timetable").html(response);
            }
        });
    }
    retrieve_print_timetable();
    
    // PRINT SELECT DEPARTMENT
    $(document).on("change", "#print-select-department", function(){
        __department = $(this).val();
        
        retrieve_section_for_plot(__department, __semester, __school_year);
        retrieve_teacher_for_plot(__department, __semester, __school_year);
        retrieve_room_for_plot(__department, __semester, __school_year);
    });

    // PRINT SELECT SEMESTER
    $(document).on("change", "#print-select-semester", function(){
        __semester = $(this).val();

        retrieve_section_for_plot(__department, __semester, __school_year);
        retrieve_teacher_for_plot(__department, __semester, __school_year);
        retrieve_room_for_plot(__department, __semester, __school_year);
    });

    // PRINT SELECT SCHOOL YEAR
    $(document).on("change", "#print-select-school-year", function(){
        __school_year = $(this).val();

        retrieve_section_for_plot(__department, __semester, __school_year);
        retrieve_teacher_for_plot(__department, __semester, __school_year);
        retrieve_room_for_plot(__department, __semester, __school_year);
    });

    // SELECT SECTION TIMETABLE FOR PRINT
    $(document).on("change", "#print-select-section", function(){
        var section = $(this).val();

        $.ajax({
            type: "POST",
            url: "../data/data.print_section_timetable.php",
            data: {
                department: __department,
                semester: __semester,
                school_year: __school_year,
                section: section,
                submit: "submit"
            },
            success: function(response){
                $("#print-section-timetable").html(response);
            }
        });
    })

    // SELECT TEACHER TIMETABLE FOR PRINT
    $(document).on("change", "#print-select-teacher", function(){
        var teacher = $(this).val();

        $.ajax({
            type: "POST",
            url: "../data/data.print_teacher_timetable.php",
            data: {
                department: __department,
                semester: __semester,
                school_year: __school_year,
                teacher: teacher,
                submit: "submit"
            },
            success: function (response) {
                $("#print-teacher-timetable").html(response);
            }
        });
    });

    // SELECT ROOM TIMETABLE FOR PRINT
    $(document).on("change", "#print-select-room", function(){
        var room = $(this).val();

        $.ajax({
            type: "POSt",
            url: "../data/data.print_room_timetable.php",
            data: {
                department: __department,
                semester: __semester,
                school_year: __school_year,
                room: room,
                submit: "submit"
            },
            success: function (response) {
                $("#print-room-timetable").html(response);
            }
        });
    })

    // BUTTON FOR PRINT SECTION TIMETABLE
    $(document).on("click", "#print-section", function(){

        printTimetable("print-section-timetable");

    });
    // BUTTON FOR PRINT TEACHER TIMETABLE
    $(document).on("click", "#print-teacher", function(){

        printTimetable("print-teacher-timetable");

    });
    // BUTTON FOR PRINT room TIMETABLE
    $(document).on("click", "#print-room", function(){

        printTimetable("print-room-timetable");

    });

    function printTimetable(timetable_id){
        var makePDF = document.getElementById(timetable_id);
        var windowPrint = window.open("", "", "height=100", "width=100")

        windowPrint.document.write(makePDF.innerHTML);
        windowPrint.document.close();
		windowPrint.focus();
		windowPrint.print();
    }

    $(document).on("click", ".sched", function(){
        alert($(this).attr('data-id'));
    })

});