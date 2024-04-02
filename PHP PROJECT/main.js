$(document).ready(function(){
    $.ajax({
        url : "all.php",
        method : "POST" ,
        success : function(data){
            let jobs = JSON.parse(data);
            let jobHtml = '';
            if(jobs.length > 0){
              jobs.forEach(job => {
                // Generate HTML for each job
                jobHtml += `
                <div class="box bg-white rounded-3 position-relative">
                        <div class="img bg-light rounded-3 border-1">
                            <img src="upload/${job.picture}" alt="">
                          
                        </div>
                        <div class="info">
                            <span class="text-primary">${job.company}</span>
                            <h4 class="fw-bold">${job.title}</h4>
                            <div class="details d-flex align-items-center gap-2">
                          
                            <span class="category bg-light-subtle p-1 px-2">${job.ategory_name}</span>
                                <span class="time p-1 px-2 h-100 d-block">
                                <i class="fa-regular fa-clock text-primary"></i>
                                    ${job.time_of_work}
                                    </span>
                                    <span class="time p-1 px-2 h-100 d-block">
                                <i class="fa-solid fa-dollar-sign text-primary"></i>
                                ${job.salary}
                                    </span>
                                    <span class="time p-1 px-2 h-100 d-block">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    ${job.address}
                                    </span>
                                    </div>
                        </div>
                        <span class="date position-absolute">${job.created_at}</span>
                        <a href="#" class="btn  d-block align-self-center ms-auto shadow-none rounded-0">Apply Now</a>
                    </div>
                    `;
                    $('.jobs').html(jobHtml);
                  });
                }
                else {
                  jobHtml = "<h3 class='h-100 d-flex justify-content-center align-items-center'>No jobs Found<h3>"
                  $('.jobs').html(jobHtml);
                }                                }
    })
    $.ajax({
        url: "categories.php",
        method: "POST",
        success: function(data) {
            let info = JSON.parse(data);
            console.log(info)
            $.each(info, (i, e) => {
                let cat = $("<li>");
                let span = $("<span>");
                let span2 = $("<span>");
                cat.append(span);
                cat.append(span2);
                cat.addClass(`category-item`);
                span.text(e.ategory_name);
                span2.text(` (${e.listing_count})`);
                $(".category-list").append(cat);
            });
            /////////////////////////////////////////////
              $(".category-item").on("click", "span", function() {
                $("#input-search").val("");
                $(".category-item span").removeClass("active");
                $(this).addClass("active")
                var cat = $(this).text();
    $.ajax({
        url: 'jobLsit.php',
        method: "POST",
        data: { category: cat },
        success: function(data) {
            let jobs = JSON.parse(data);
            let jobHtml = '';
            if(jobs.length > 0){
              jobs.forEach(job => {
                // Generate HTML for each job
                jobHtml += `
                <div class="box bg-white rounded-3 position-relative">
                        <div class="img bg-light rounded-3 border-1">
                            <img src="upload/${job.picture}" alt="">
                            
                        </div>
                        <div class="info">
                            <span class="text-primary">${job.company}</span>
                            <h4 class="fw-bold">${job.title}</h4>
                            <div class="details d-flex align-items-center gap-2">
                            <span class="category bg-light-subtle p-1 px-2">${job.ategory_name}</span>
                                <span class="time p-1 px-2 h-100 d-block">
                                <i class="fa-regular fa-clock text-primary"></i>
                                    ${job.time_of_work}
                                    </span>
                                <span class="time p-1 px-2 h-100 d-block">
                                <i class="fa-solid fa-dollar-sign text-primary"></i>
                                ${job.salary}
                                    </span>
                                    <span class="time p-1 px-2 h-100 d-block">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    ${job.address}
                                    </span>
                                    </div>
                        </div>
                        <span class="date position-absolute">${job.created_at}</span>
                        <a href="#" class="btn  d-block align-self-center ms-auto shadow-none rounded-0">Apply Now</a>
                    </div>
                    `;
                    $('.jobs').html(jobHtml);
                  });
                }
                else {
                  jobHtml = "<h3 class='h-100 d-flex justify-content-center align-items-center'>No jobs Found<h3>"
                  $('.jobs').html(jobHtml);
                }
        }
    });
});

        }
    });
    $(".btn-search").on("click", ()=>{
      var search = $("#input-search").val();
      $(".category-item span").removeClass("active");
      if(search != ""){
        $.ajax({
          url:'search.php',
                        method : "POST",
                        data :{input : search},
                        success:function(data){
                      let jobs = JSON.parse(data);
            let jobHtml = '';
            if(jobs.length > 0){
              jobs.forEach(job => {
                jobHtml += `
                <div class="box bg-white rounded-3 position-relative">
                        <div class="img bg-light rounded-3 border-1">
                            <img src="upload/${job.picture}" alt="">
                          
                        </div>
                        <div class="info">
                            <span class="text-primary">${job.company}</span>
                            <h4 class="fw-bold">${job.title}</h4>
                            <div class="details d-flex align-items-center gap-2">
                            <span class="category bg-light-subtle p-1 px-2">${job.ategory_name}</span>
                                <span class="time p-1 px-2 h-100 d-block">
                                <i class="fa-regular fa-clock text-primary"></i>
                                    ${job.time_of_work}
                                    </span>
                                    <span class="time p-1 px-2 h-100 d-block">
                                <i class="fa-solid fa-dollar-sign text-primary"></i>
                                ${job.salary}
                                    </span>
                                    <span class="time p-1 px-2 h-100 d-block">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    ${job.address}
                                    </span>
                                    </div>
                        </div>
                        <span class="date position-absolute">${job.created_at}</span>
                        <a href="#" class="btn  d-block align-self-center ms-auto shadow-none rounded-0">Apply Now</a>
                    </div>
                    `;
                    $('.jobs').html(jobHtml);
                  });
                }
                else {
                  jobHtml = "<h3 class='h-100 d-flex justify-content-center align-items-center'>No jobs Found<h3>"
                  $('.jobs').html(jobHtml);
                }                        }
                      })
            }
    })
});