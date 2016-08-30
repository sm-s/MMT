<nav class="large-2 medium-4 columns" id="actions-sidebar">    
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Public statistics'), ['controller' => 'Projects', 'action' => 'statistics']) ?> </li>
        <li><?= $this->Html->link(__('FAQ'), ['controller' => 'Projects', 'action' => 'faq']) ?> </li>
    </ul>    
</nav>

<div id="faq" class="projects index large-9 medium-18 columns content float: left">
    <h3><?= __('FAQ') ?></h3>
     
    <ol>
      <li><a accesskey="alt+1 "href="#Q1">For students of PW and SPM courses in fall 2016</a></li>
      <li><a accesskey="alt+2"><?= $this->Html->link('What can I use the Metrics Monitoring Tool (MMT) for?', array('controller' => 'projects', 'action' => 'faq', '#' => 'Q2')) ?></a></li>
      <li><a accesskey="alt+3" href="#Q3">How do I get started?</a></li>
      <li><a accesskey="alt+4" href="#Q4">I forgot my password. How do I get a new one?</a></li>
      <li><a accesskey="alt+5" href="#Q5">How can I change my password?</a></li>
      <li><a accesskey="alt+6" href="#Q6">As a project manager, how do I do the weekly reporting of my project?</a></li>
      <li><a accesskey="alt+7" href="#Q7">How do I log my daily working time?</a></li>
      <li><a accesskey="alt+8" href="#Q8">Where can I find team's/member's working hours and the total number of working hours?</a></li>
      <li><a accesskey="alt+9" href="#Q9">How can I view the progress of my project?</a></li>
      <li><a href="#Q10">How can I view the progress of other projects?</a></li>
    </ol>
    
    <h4 id="Q1">1. For students of PW and SPM courses in fall 2016</h4>
    <p>
    For developers and managers:
          <ul >
             <li>Week 38 is the first weekly report week thus the first week to log time for.</li>
             <li>Since you cannot log lectures on the actual dates, you can log those hours on this week.</li>
          </ul>
    For managers:
      	<ul >
           <li>First weekly report deadline: September 26th (Monday)</li>
	   <li>For all teams, the phase will be 0 in the first weekly report.</li>
        </ul>
        <a href="#">[back to the top]</a> 
    </p>
	
    <h4 id="Q2">2. What can I use the Metrics Monitoring Tool (MMT) for?</h4>
    <p>
    All project members can:
        <ul>
            <li>view the progress of your project</li>
            <li>view the progress of other public projects</li>
            <li>leave comments on the weekly reports of your project</li>
            <li>give feedback on MMT</li>
            <ul>
                <li>log in and select your project</li>
                <li>click the "Give feedback" link on left hand side</li>
            </ul>
        </ul>
    As a project manager you can:
      	<ul >
           <li>add members to your project team</li>
	   <li>log your daily working time</li>
	   <li>do the weekly reporting of your project</li> 
        </ul>
        As a developer you can:
          <ul >
             <li>log your daily working time</li>
          </ul>
        <a href="#">[back to the top]</a> 
    </p>

    <h4 id="Q3">3. How do I get started?</h4>
    <p>
      As a project manager:
      	<ul >
           <li>create a user ID for yourself by signing up in MMT</li>
	   <li>contact your course supervisor and 1) provide him/her with your user ID 2) ask him/her to create your project in MMT with you as a project manager</li>
	   <li>add your team members as developers to your project - and you are good to go!</li>
        </ul>
      As a developer:
      	<ul >
           <li>create a user ID for yourself by signing up in MMT</li>
	   <li>contact your project manager and 1) provide him/her with your user ID 2) ask him/her to add you as a developer to your project</li>
        </ul>      
      <a href="#">[back to the top]</a>
    </p>

    <h4 id="Q4">4. I forgot my password. How do I get a new one?</h4>
    <p>
      Contact the MMT administrator Pekka Mäkiaho at pekka.makiaho(at)uta.fi, who will send you a new password.<br /> 
      Remember to change the password after the first log in! For changing your password see <a accesskey="alt+4" href="#Q4">How can I change my password/edit my profile?</a></li>
       <br />  
       <br /> 
       <a href="#">[back to the top]</a>
    </p>

    <h4 id="Q5">5. How can I change my password/edit my profile?</h4>
    <p>
      You can change your password and edit your profile by clicking the "Profile" link at the top right corner of MMT. Make the desired changes and click "Submit".<br />
      Ps. Your password is encrypted upon submitting it. That is why it seems to have a lot more characters on the screen than what you entered. Safe and sound!
      <br />
      <br />      
      <a href="#">[back to the top]</a>
    </p>

    <h4 id="Q6">6. As a project manager, how do I do the weekly reporting of my project?</h4>
    <p>
    A weekly report covers a calendar week. A report should be send on Monday following the weekly report week. 
    For example, if a weekly report week covers week 40 (in 2016, from October 4th to 9th), 
    the report should be sent on Monday (October 10th).
    </p>
    <p>
    You can enter the weekly project reports into MMT as follows:
      	<ul>
           <li>log in and select the project you want to enter a weekly report for</li>
	   <li>click the "Weeklyreports" tab at the top of the screen</li>
	   <li>click the "New Weeklyreport" link in the Actions pane on the left hand side</li>
	   <li>enter the weekly report data 
                <ul>
                    <li>page 1: the basic data</li>
                    <li>page 2: the metric data</li>
                    <li>page 3: the working hours of your team members</li>
                </ul>
           </li>
	   <li>if your team logs the daily working time in MMT (see <a accesskey="alt+6" href="#Q6">
	   How do I log my daily working time?</a>), the page 3 will automatically suggest the working hours of your team members</li>
	   <li>click "Submit" once you are done, and your weekly report is saved</li>
        </ul> 
      <a href="#">[back to the top]</a>
    </p>

    <h4 id="Q7">7. How do I log my daily working time?</h4>
    <p>
        You log time between Monday that follows the last weekly report week and the current day. 
        However, the first week may be different 
        as then the week starts from the day project was created instead of Monday.
    </p>
    <p>
        You can log time late but only for the week that is covered by the last weekly report. 
        For example, if a report for week 40 was sent on Monday October 10th 2016, 
        you can still log time for week 40. However, you need to use a 'Log time late' form. 
    </p>
    <p>  
      You can log your daily working time in MMT as follows:
      	<ul >
           <li>log in and select the project you want to log time for</li>
	   <li>click the "Log time" tab at the top of the screen</li>
	   <li>click the "Log time" link on the left hand side</li>
	   <li>enter the date, description, duration (hours) and work type for the time to be logged</li>
	   <li>click "Submit" once you are done, and your logged time is saved</li>
         </ul>
     Please note that you can log time late, but only for the week of the last weekly report.
        <ul>
            <li>click the "Reports" tab at the top of the screen</li>
            <li>click the "View" link next to the last weekly report</li>
            <li>click the "Log time late" link on the left hand side menu</li>
        </ul>
      <a href="#">[back to the top]</a>
     </p>

    <h4 id="Q8">8. Where can I find team's/member's working hours and the total number of working hours?</h4>
       <p>
           You can view the working hours and the total numbers of hours as follows. 
            <ul>
                <li>log in and select your project</li>
                <li>to view the total numbers of hours per team and per member: 
                    <ul>click the "Members" link on the left hand side menu on the project's front page</ul>
                </li>
                <li>to view the total number of hours by worktype (per member): 
                    <ul>click the "View" link in the Actions column of the "Members" table</ul>
                </li>
                <li>to view member's working hours: 
                    <ul>click the "Logged tasks" link on the left hand side menu on member's page</ul>
                </li>
                <li>to view team's working hours: 
                    <ul>click the "Log time" tab at the top menu</ul>
                </li>
            </ul>
        <a href="#">[back to the top]</a>
       </p>

    <h4 id="Q9">9. How can I view the progress of my project?</h4>
    <p>
      You can view the progress of your project as follows:
	<ul >
           <li>log in and select the project whose progress you want to view</li>
	   <li>click the "Charts" tab at the top of the screen</li>
	   <li>you now see the progression of the selected project in charts, based on the provided weekly report data</li>
	   <li>you can change the viewing period by amending the min and max weeks and years in the Edit limits section in the Actions pane on the left hand side</li>
	</ul> 
      <a href="#">[back to the top]</a>
    </p>

    <h4 id="Q10">10. How can I view the progress of other projects?</h4>
    <p>
      You can view the progress of other projects similarly as your own project in <a accesskey="alt+7" href="#Q7"> How can I view the progress of my project?</a>, 
	if the project is classified as "public" in the project's basic data by the administrator. 
      <br />
      Additionally, you can view the combined statistics of all public projects by clicking "Home" at the top of the screen, and then the "Public statistics"
      in the Actions pane.
      <br />
      <br />
      <a href="#">[back to the top]</a>
    </p>
</div>
