// globale variabelen
let song, image; 
let analyzer; 
let smallPoint, largePoint; 
let canvas

// sound en image inladen via preload zodat dit gebeurd voor de setup functie 
function preload() {
    image = loadImage('uploads/image.jpeg'); 
    console.log(image.widht / 2); 
    console.log(image.height / 2);

    song = loadSound('uploads/song.mp3');
}

// setup functie die eenmaal wordt geladen bij de opstart 
function setup() {

    canvas = createCanvas(image.width, image.height);

    // IMAGE
    imageMode(CENTER); 
    smallPoint = 1; 
    largePoint = 10;
    noStroke(); 
    background(255); 
    image.loadPixels(); 

    // SOUND
    analyzer = new p5.Amplitude(); 
    // patch the input to a volume analyzer 
    analyzer.setInput(song); 
}

// draw functie is een loop die blijft doorgaan tijdens het project
function draw() {

    // SOUND
    // get the average (root mean square amplitude) 
    let rms = analyzer.getLevel(); 
    let dimension = rms * 50;
    
    // IMAGE 
    let pointillize = map(dimension, 0, width, smallPoint*dimension, largePoint*dimension); 
    let x = floor(random(image.width)); 
    let y = floor(random(image.height)); 
    let pixel = image.get(x, y); 
    fill(pixel, 128); 
    ellipse(x, y, pointillize, pointillize); 
}

// proces start als er geklikt wordt 
function mousePressed() {
    if (song.isPlaying()) {
        song.pause(); 
    } else {
        song.play();
    }
}

// wanneer er op de s geklikt wordt, wordt de gecreëerde image opgeslagen
function keyPressed() {
    if (keyCode === 's' || 'S') {
        save(canvas, 'evoked-memory');
    }
}