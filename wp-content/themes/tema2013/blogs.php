<?php 

/*Template Name: Blogs */
 
get_header(); ?>

<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="http://dummyimage.com/1020x300/eee/fff.png" alt="">
            <div class="carousel-caption">
                <h4>First Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
        </div>
        <div class="item">
            <img src="http://dummyimage.com/1020x300/eee/fff.png" alt="">
            <div class="carousel-caption">
                <h4>Second Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
        </div>
        <div class="item">
            <img src="http://dummyimage.com/1020x300/eee/fff.png" alt="">
            <div class="carousel-caption">
                <h4>Third Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
</div>

<div id="sa_blogs">
	<div class="row-fluid">
		<div class="span4">
			<h2>Lead Management</h2>
			<ul>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
			</ul>
			<a href="#" class="btn btn-large btn-block btn-primary">Lista completa</a>
		</div>
		<div class="span4">
			<h2>Fidelização</h2>
			<ul>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
			</ul>
			<a href="#" class="btn btn-large btn-block btn-primary">Lista completa</a>
		</div>
		<div class="span4">
			<h2>Cases</h2>
			<ul>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
				<li>
					<h3>Título 1</h3>
					<p>In et elementum risus, sit amet elementum velit. Phasellus fermentum, elit sed dapibus euismod, purus eros gravida arcu, non nullam sodales.</p>
				</li>
			</ul>
			<a href="#" class="btn btn-large btn-block btn-primary">Lista completa</a>
		</div>
	</div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>