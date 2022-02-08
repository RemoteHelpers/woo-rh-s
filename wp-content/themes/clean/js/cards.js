let skills = Array.from(document.querySelectorAll(".skill-items"));
skills.forEach((skillBox,i)=>{
    skillBox.querySelectorAll('a').forEach((skill,j)=>{
        if (j>3) {
            skill.setAttribute('style', "display: none;")
        }
    })
})



$(function(){
    $(".skill-items").each(function(indx, el){
        $(".count",el).text($('a',el).length - 4)
    });
});