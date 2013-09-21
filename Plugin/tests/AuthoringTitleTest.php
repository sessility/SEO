<?php

include_once(__DIR__ . '/../SEO/authoring/titles.php');

class AuthoringTitlesTest extends PHPUnit_Framework_TestCase {

    public function testBase() {
        $o = new Sseo_AuthoringTitles();

        $this->assertTrue($o instanceof Sseo_AuthoringTitles);
    }

    public function testNothing() {

        $o = new Sseo_AuthoringTitles();

        $title = '';
        $body = '';

        $this->assertTrue($o->inPost($title, $body) === -1);

    }

    public function testTitleNotInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = '';

        $this->assertTrue($o->inPost($title, $body) === -1);

    }

    public function testTitleLateInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum sapien cursus ac. Morbi fermentum faucibus rhoncus. Fusce porta risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Aenean eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula massa, rutrum sed consectetur ac, mattis vitae urna. Dogs and something cats.';

        $this->assertTrue($o->inPost($title, $body) === 0);

    }

    public function testTitleMiddleInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum sapien cursus ac. Morbi fermentum faucibus rhoncus. Fusce porta risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Dogs and something cats. Aenean eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula massa, rutrum sed consectetur ac, mattis vitae urna.';

        $this->assertTrue($o->inPost($title, $body) === 1);

    }

    public function testTitleEarlyInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = ' Lorem ipsum dolor dogs and cats sit amet, consectetur adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum sapien cursus ac. Morbi fermentum faucibus rhoncus. Fusce porta risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Aenean eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula massa, rutrum sed consectetur ac, mattis vitae urna.';

        $this->assertTrue($o->inPost($title, $body) === 2);

    }

    public function testTitleNoFrequencyInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = 'Consectetur adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum sapien cursus ac. Morbi fermentum faucibus rhoncus. Fusce porta risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Aenean eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula massa, rutrum sed consectetur ac, mattis vitae urna.';

        $this->assertTrue($o->frequencyInPost($title, $body) === -1);

    }

    public function testTitleSeldomInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = ' Lorem ipsum dolor dogs and cats sit amet, consectetur adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum sapien cursus ac. Morbi fermentum faucibus rhoncus. Fusce porta risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Aenean eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula massa, rutrum sed consectetur ac, mattis vitae urna.';

        $this->assertTrue($o->frequencyInPost($title, $body) === 0);

    }

    public function testTitleOftenInPost() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = ' Lorem ipsum dolor dogs and cats sit amet, consectetur adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra dogs and cats erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum dogs and cats sapien cursus ac. Morbi fermentum faucibus rhoncus. Fusce porta risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Aenean eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula massa, rutrum sed consectetur ac, mattis vitae urna.';

        $this->assertTrue($o->frequencyInPost($title, $body) === 1);

    }

    public function testPostLitteredWithTitle() {

        $o = new Sseo_AuthoringTitles();

        $title = 'Dogs and cats';
        $body = ' Lorem ipsum dolor dogs and cats sit amet, consectetur dogs and cats adipiscing elit. Fusce lacinia eu risus ac viverra. Nunc fringilla, nibh eget dapibus accumsan, dui dolor pharetra dogs and cats erat, eu fringilla justo risus sed odio. Nullam risus dolor, malesuada eu feugiat vel, ultricies ultrices ante. Aliquam scelerisque aliquet dignissim. Maecenas dogs and cats posuere porta ultricies. Mauris condimentum dolor arcu, eu venenatis eros varius et. Duis venenatis laoreet erat, ac dictum dogs and cats sapien cursus dogs and cats ac. Morbi fermentum faucibus rhoncus dogs and cats. Fusce porta dogs and cats risus nulla, non mattis enim elementum sit amet. Curabitur tincidunt magna in justo tempus iaculis. Mauris ac interdum odio. Aenean dogs and cats eleifend hendrerit tempor.

Fusce sit amet dictum dolor. Duis tellus odio, aliquam sit amet nibh ac, facilisis dignissim enim. Nam dogs and cats mollis turpis eu purus ullamcorper, vel adipiscing sapien tempus. Etiam iaculis faucibus est, eget iaculis lorem interdum at. Nam sit amet sapien ut dogs and cats magna egestas rhoncus nec sed nulla. Mauris rhoncus suscipit mattis. Proin ligula dogs and cats massa, rutrum sed consectetur ac, dogs and cats mattis vitae urna.';

        $this->assertTrue($o->frequencyInPost($title, $body) === 2);

    }

}
?>
