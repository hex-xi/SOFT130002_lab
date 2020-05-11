const works = [
    { author: "Micheal Jackson",lifetime:"1022-1055",tips: "Human", photos: ["human1.jpg","human2.jpg","human3.jpg"] },
    { author: "Maria JK",lifetime:"1920-2001", tips: "Classical", photos: ["classical1.jpg","classical2.jpg"] },
    { author: "John Herry UY", lifetime:"1894-1928",tips: "Abstract", photos: ["abstract1.jpg","abstract2.jpg","abstract3.jpg","abstract4.jpg","abstract5.jpg"] },
    { author: "Coco",lifetime:"1777-1799", tips: "Beauty",  photos: ["beauty1.jpg","beauty2.jpg"] }
];
//获得挂载所需的父节点
var fatherNode = document.querySelectorAll(".flex-container")[0];
//创造单例item
function creatOne(i) {
    //创建新节点
    let newDivNode = document.createElement("div");
    //设置节点属性 class=item
    newDivNode.setAttribute("class","item");
    //拼接节点html内容
    let html = "<h4>Genre:"+works[i].tips+"</h4>\n" +
        "        <div class=\"inner-box\" >\n" +
        "            <h3 style=\"display:inline\">"+works[i].author+"</h3>\n" +
        "            <p style=\"display:inline;font-weight: bold;margin-left: 10px\">lifetime:"+works[i].lifetime+"</p>\n" +
        "        </div>\n" +
        "        <div class=\"inner-box\">\n" +
        "            <h3>Popular Photos</h3>\n" ;
    for(let photo of works[i].photos){
        html+="            <img src=\""+photo+"\" alt=\"human1\" class=\"photo\">\n" ;
    }
    html+="        </div>\n" +
        "        <button style=\"margin-top: 10px\">Visit</button>";
    //将html内容流写入节点中
    newDivNode.innerHTML = html;
    //将节点添加到显示父节点中
    fatherNode.appendChild(newDivNode);
}
//创造全部item
function creatAll(){
    for(let i =0;i<works.length;i++){
        creatOne(i);
    }
}
//执行函数
creatAll();