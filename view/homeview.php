<?php
class HomeView {

  public static function home() {
    return
    '<div>
      <h1>Főoldal</h1>
      <div class="content">
        <p>It&#39;s a really simple php application, based on an MVC pattern. I&#39;d like to
        have a system which is implemented in core PHP (no framework or CMS can be
        used) and it is:</p>
        <ul>
          <li>URL mapped (.htaccess rewrite)</li>
          <li>Based on an MVC pattern</li>
          <li>Object oriented</li>
          <li>Uses database (MySQL)</li>
        </ul>
        <h2>Requirements:</h2>
        <p>The application should have 2 database tables: users (id, name) and
        advertisements (id, userid, title).</p>
        <ul>
          <li>As a user I&#39;d like a page that shows the list of the users existing in
          the system.</li>
          <li>As a user I&#39;d like a page that shows the list of the existing
          advertisements in the system (and the related user&#39;s name of course)</li>
          <li>They should be different pages</li>
          <li>So the system should contain 3 pages:
          -&gt; index, with the links to the user list and the advertisement list
          -&gt; user list
          -&gt; advertisement list
          -&gt; The whole system should have a minimalist design (css)</li>
        </ul>
        <h2>In summary:</h2>
        <p>So it&#39;s a 3 paged application, with a minimal design, and database access,
        which is URL mapped, and based on an MVC pattern. No framework or CMS
        allowed to use.
        I need the source of the application, which I expect to be about 6-8 files.
        Here can be a difference of course.</p>
        <h2>Requirements regarding the implementation:</h2>
        <ul>
          <li>Must be object oriented!</li>
          <li>Must have at least 1 layer under the Controller layer</li>
          <li>Model and service methods should be separated. Model here should be
          clear, used only for representation.</li>
          <li>Must have a nice, and well documented code</li>
          <li>A very simple css, in minimal style</li>
        </ul>
        <p>This is important for us, it helps with the decision. If you can solve
        this, you definitely can fit to our project.</p>
        <p>Let me know if you have any questions.</p>
      </div>
    </div>';
  }
}
?>