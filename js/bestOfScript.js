/**
 * Add Movie Card to the Segment in HTML
 * @param movieName     {string}    Movie Name to diplay
 * @param movieGenre    {array}     List of Movie Genre to diplay
 * @param movieRating   {integer}   Movie Rating to diplay
 */
function addSegmentCard(movieName="Name", movieGenre=["Genre"], movieRating=5, imgSrc="") {
    card =  '<div class="segment_card">';
    card += `<a href=""><img src="${imgSrc}" alt="Movie Cover" class="movie-cover"></a>`;
    card += '<div>';
    card += `<p>${movieName}</p>`;

    card += "<p>"
    movieGenre.forEach(element => {
        card += `#${element}, `;
    });

    card = card.slice(0,-2) +"</p>"
    card += `<p>${movieRating}</p>`;
    card += '</div>';
    card += '</div>';

    document.getElementById("segment_container").innerHTML += card;
}

// /**
//  * Add Movie Card to the Segment in HTML
//  * @param movieObj     {Object}    Movie Object contains all the data
//  */
// function NEWaddSegmentCard(movieObj) {
//     // NEED TO DRAFT OBJECT MODEL

//     card =  '<div class="segment_card">';
//     card += '</div>';

//     document.getElementById("segment_container").innerHTML += card;
// }

// /**
//  * Add Movie Card to the Segment in HTML
//  * @param pageName     {string}    Page Name to be Navigate
//  */
// function changeNavingation(pageName="Trending") {
//     key = ["Trending", "New Release", "Upcoming", "Recent Updates"].indexOf(pageName);

//     // clear card segment
//     document.getElementById("segment_container").innerHTML = "";

//     // get data from php
//     // TO DO!!!

//     // add new card segment
//     switch (key) {
//         case 0:
//             // alert("Displaying "+pageName+" Page"+key);
//             addSegmentCard("StarTrek", ["Action", "Scifi"], 3, "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse3.mm.bing.net%2Fth%3Fid%3DOIP.Yf-KcCj2eVhPZaaqToitegHaK-%26pid%3DApi&f=1&ipt=1bfade328059e568c27926ad7d50674aac0126fe8b289dad9b9305ee69f97b2c&ipo=images");
//             break;
//         case 1:
//             // alert("Displaying "+pageName+" Page"+key);
//             addSegmentCard("All Or Nothing", ["Comedy", "Love"], 2, "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fen%2Fthumb%2Fc%2Fcb%2FAll_or_Nothing_DVD_cover.jpg%2F220px-All_or_Nothing_DVD_cover.jpg&f=1&nofb=1&ipt=6525d5f61f5a05c9ed46669a26f68daf74d423860ff6cbc2358c88ca82f00674&ipo=images");
//             break;
//         case 2:
//             // alert("Displaying "+pageName+" Page"+key);
//             addSegmentCard("Harry Potter", ["Horror", "Fantasy"], 0, "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fen%2Fc%2Fc0%2FHarry_Potter_and_the_Chamber_of_Secrets_movie.jpg&f=1&nofb=1&ipt=0b3d20f6ba2070a96fd4f2b2e9ff5c8ca3e1b6d143680216a8476f62a0a41c6c&ipo=images");
//             break;
//         case 3:
//             // alert("Displaying "+pageName+" Page"+key);
//             addSegmentCard();
//             break;
//         default:
//             alert(`[ ERROR ] ${pageName} Does Not Exist!`);
//             break;
//     }
// }