<?php

namespace App\Services;

use RuntimeException;
use OpenAI;

class AiAssistantService
{
    public function chat(string $message): string
    {
        $message = trim($message);

        /*
        |--------------------------------------------------------------------------
        | Development / Mock Mode
        |--------------------------------------------------------------------------
        */

        if (config('services.openai.mock_mode')) {
            return $this->mockResponse($message);
        }

        $apiKey = config('services.openai.api_key');

        if (!$apiKey) {
            throw new RuntimeException(
                'OPENAI_API_KEY is not configured.'
            );
        }

        $client = OpenAI::client($apiKey);

        $response = $client->responses()->create([
            'model' => config(
                'services.openai.model',
                'gpt-5.6-luna'
            ),

            'instructions' => $this->systemPrompt(),

            'input' => $message,
        ]);

        return $response->outputText;
    }

    /*
    |--------------------------------------------------------------------------
    | DevNext AI System Prompt
    |--------------------------------------------------------------------------
    */

    protected function systemPrompt(): string
    {
        return <<<PROMPT
You are DevNext AI, the official AI assistant of the DevNext platform.

ABOUT DEVNEXT
DevNext is a developer-focused platform created by the STA Coding Team.

STA means:
- S — Sarong (Ariel)
- T — Tallie (Chery)
- A — Angulo (Angel)

The developers behind DevNext are:
- Sarong (Ariel)
- Tallie (Chery)
- Angulo (Angel)

Official DevNext contact:
devnextteam@gmail.com

DEVNEXT FEATURES

Users can:
- Create an account
- Sign in
- Manage their developer profile
- Add a profile picture
- Set a username
- Add a professional headline
- Write a developer bio
- Add skills
- Add GitHub
- Add a personal website
- Create projects
- Edit their projects
- Publish projects
- Upload project images
- Add project descriptions
- Add categories
- Add GitHub links
- Add live demo links
- Add project videos
- Upload project resources
- Create project guides/instructions
- Like projects
- Save projects
- Follow developers
- View followers
- View following
- Discover developers
- Search developers
- Receive notifications
- Access premium projects when subscribed

PROJECTS

Developers can showcase their projects on DevNext.
Projects may contain:
- Title
- Description
- Category
- Project image
- GitHub/source code link
- Live demo link
- Project video
- Step-by-step project guide
- Project resources
- Premium/free status

Only published projects should appear publicly on developer profiles.

PROJECT RESOURCES

Project creators can provide useful files/resources related to their project.
Resources can be viewed or downloaded by users when access is allowed.

PROJECT GUIDES

Projects can include step-by-step instructions to help other developers understand or recreate the project.

SOCIAL FEATURES

Users can:
- Follow developers
- Unfollow developers
- See follower counts
- See following counts
- Like projects
- Save projects
- View saved projects

NOTIFICATIONS

Users receive notifications for relevant activity such as new followers.
Visiting the Notifications page marks unread notifications as read.

PREMIUM

Some projects can be premium.
Premium access can require an active subscription.
Administrators have permanent access.

AUTHENTICATION

DevNext supports:
- Registration
- Login
- Password reset
- Password updates
- Profile information updates
- Additional account security features

DEVELOPER DISCOVERY

The Developers section allows users to discover other developers.
Developers can be searched using profile information such as:
- Username
- Headline
- Bio

ADMINISTRATION

Administrators can manage DevNext content and users.
Admin functionality includes project management and user management.

AI ASSISTANT

DevNext AI helps users understand the platform and learn programming.
It can answer questions about:
- DevNext
- Developers
- Projects
- Profiles
- Social features
- Notifications
- Premium access
- Programming
- HTML
- CSS
- JavaScript
- PHP
- Laravel

Never invent information about DevNext or its developers.
PROMPT;
    }

    /*
    |--------------------------------------------------------------------------
    | Mock DevNext Knowledge Base
    |--------------------------------------------------------------------------
    */

    protected function mockResponse(string $message): string
    {
        $message = strtolower(trim($message));

        /*
        |--------------------------------------------------------------------------
        | Greetings
        |--------------------------------------------------------------------------
        */

        if (
            $message === 'hi' ||
            $message === 'hello' ||
            $message === 'hey' ||
            $message === 'hiya' ||
            str_starts_with($message, 'hello ') ||
            str_starts_with($message, 'hi ') ||
            str_starts_with($message, 'hey ')
        ) {
            return <<<TEXT
Hello! 👋 I'm DevNext AI.

I'm here to help you understand DevNext, discover its features, learn about the STA Coding Team, and answer programming-related questions.

You can ask me things like:

• "Who are the developers?"
• "How do I add a project?"
• "How do I follow a developer?"
• "Where can I find saved projects?"
• "How do notifications work?"
• "What are premium projects?"
• "How can I contact the team?"
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Who are the developers?
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'who are the developers') ||
            str_contains($message, 'who are the developer') ||
            str_contains($message, 'who developed devnext') ||
            str_contains($message, 'who made devnext') ||
            str_contains($message, 'who created devnext') ||
            str_contains($message, 'who built devnext') ||
            str_contains($message, 'who is behind devnext') ||
            str_contains($message, 'who runs devnext') ||
            str_contains($message, 'devnext team') ||
            str_contains($message, 'developers here') ||
            str_contains($message, 'developer here') ||
            str_contains($message, 'who created this website') ||
            str_contains($message, 'who made this website')
        ) {
            return <<<TEXT
DevNext was created by the STA Coding Team.

The developers are:

• Sarong (Ariel)
• Tallie (Chery)
• Angulo (Angel)

STA stands for Sarong, Tallie, and Angulo. 👨‍💻
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | STA
        |--------------------------------------------------------------------------
        */

        if (
            preg_match('/\bwhat is sta\b/', $message) ||
            str_contains($message, 'what does sta mean') ||
            str_contains($message, 'what does sta stand for') ||
            str_contains($message, 'sta coding team')
        ) {
            return <<<TEXT
STA is the name of the coding team behind DevNext.

It represents the three developers:

S — Sarong (Ariel)
T — Tallie (Chery)
A — Angulo (Angel)
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Contact
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'how can i contact') ||
            str_contains($message, 'how can we contact') ||
            str_contains($message, 'how do i contact') ||
            str_contains($message, 'how to contact') ||
            str_contains($message, 'contact the developers') ||
            str_contains($message, 'contact developers') ||
            str_contains($message, 'contact them') ||
            str_contains($message, 'contact the team') ||
            str_contains($message, 'contact sta') ||
            str_contains($message, 'developer email') ||
            str_contains($message, 'developers email') ||
            str_contains($message, 'team email') ||
            str_contains($message, 'contact email') ||
            str_contains($message, 'what is your email') ||
            str_contains($message, 'what is the email') ||
            str_contains($message, 'email address')
        ) {
            return <<<TEXT
You can contact the STA Coding Team through the official DevNext email:

📧 devnextteam@gmail.com

You can use this email for questions, concerns, feedback, or inquiries about DevNext.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | What is DevNext?
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'what is devnext') ||
            str_contains($message, 'what is dev next') ||
            str_contains($message, 'tell me about devnext') ||
            str_contains($message, 'about devnext') ||
            str_contains($message, 'what does devnext do') ||
            str_contains($message, 'what is this website') ||
            str_contains($message, 'what is this site')
        ) {
            return <<<TEXT
DevNext is a developer-focused platform created by the STA Coding Team.

It gives developers a place to:

• Create a developer profile
• Showcase projects
• Share project resources
• Provide project guides
• Discover other developers
• Follow developers
• Like projects
• Save projects
• Receive notifications
• Access premium projects

DevNext is designed to bring developer profiles, projects, learning resources, and community features together in one platform.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | What can I do here?
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'what can i do here') ||
            str_contains($message, 'what can i do on devnext') ||
            str_contains($message, 'what can i do') ||
            str_contains($message, 'what features') ||
            str_contains($message, 'features of devnext') ||
            str_contains($message, 'what does this website have') ||
            str_contains($message, 'what are the features')
        ) {
            return <<<TEXT
DevNext has several features for developers and users.

You can:

👤 Developer Profiles
Create and customize your developer profile with a username, headline, bio, skills, GitHub, website, and profile picture.

💻 Projects
Create and showcase your development projects.

📁 Project Resources
Share useful project files and resources.

📖 Project Guides
Add step-by-step instructions to explain how a project works.

🔎 Developer Discovery
Search for and discover other developers.

👥 Following
Follow developers and see their follower/following information.

❤️ Project Likes
Like projects you find interesting.

🔖 Saved Projects
Save projects so you can find them again later.

🔔 Notifications
Receive notifications about relevant activity, including new followers.

⭐ Premium Projects
Some projects can require an active subscription.

🤖 DevNext AI
Ask questions about DevNext or programming.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Do I need an account?
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'do i need an account') ||
            str_contains($message, 'need an account') ||
            str_contains($message, 'do i have to register') ||
            str_contains($message, 'do i need to register') ||
            str_contains($message, 'can i use devnext without an account')
        ) {
            return <<<TEXT
Some DevNext content can be viewed publicly, such as developer profiles and published projects.

However, an account is needed for user-specific features such as:

• Creating your own profile
• Creating projects
• Following developers
• Liking projects
• Saving projects
• Receiving notifications
• Managing your account
• Accessing subscription-based features
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Add / Create / Upload Projects
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'add a project') ||
            str_contains($message, 'add projects') ||
            str_contains($message, 'add project') ||
            str_contains($message, 'create a project') ||
            str_contains($message, 'create projects') ||
            str_contains($message, 'upload a project') ||
            str_contains($message, 'upload project') ||
            str_contains($message, 'submit a project') ||
            str_contains($message, 'showcase a project') ||
            str_contains($message, 'showcase my project') ||
            str_contains($message, 'put my project') ||
            str_contains($message, 'how do i add') && str_contains($message, 'project') ||
            str_contains($message, 'how can i add') && str_contains($message, 'project') ||
            str_contains($message, 'how do i create') && str_contains($message, 'project') ||
            str_contains($message, 'how can i create') && str_contains($message, 'project') ||
            str_contains($message, 'where do i upload') && str_contains($message, 'project')
        ) {
            return <<<TEXT
You can add your own projects through the "My Projects" section of your DevNext account.

The general process is:

1. Open "My Projects" from the sidebar.
2. Choose "Add New Project".
3. Enter your project title.
4. Add a description explaining your project.
5. Choose a category.
6. Add a project image if you have one.
7. Add your GitHub/source-code link when available.
8. Add your Live Demo link when available.
9. Add a project video when appropriate.
10. Add project resources if you want to provide files.
11. Add a project guide if you want to provide instructions.
12. Save the project.
13. Publish it when you're ready.

Once published, the project can be showcased through your developer profile.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Project Editing
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'edit my project') ||
            str_contains($message, 'edit a project') ||
            str_contains($message, 'change my project') ||
            str_contains($message, 'update my project') ||
            str_contains($message, 'modify my project')
        ) {
            return <<<TEXT
You can manage your own projects from the "My Projects" section.

You can edit project information such as the title, description, category, image, links, video, and other project details.

You can also manage project resources and project instructions from the project management area.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Publish Projects
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'publish my project') ||
            str_contains($message, 'how do i publish') ||
            str_contains($message, 'how to publish') ||
            str_contains($message, 'make my project public') ||
            str_contains($message, 'show my project publicly')
        ) {
            return <<<TEXT
After creating or editing your project in "My Projects", you can publish it when it is ready.

Publishing makes the project eligible to appear publicly, including on your developer profile.

Keeping a project unpublished allows you to continue working on it before showing it to other users.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Project Image
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'project image') ||
            str_contains($message, 'project picture') ||
            str_contains($message, 'project photo') ||
            str_contains($message, 'add an image to my project')
        ) {
            return <<<TEXT
Projects can have a project image to make the project showcase more visual.

You can add or update the project image while creating or editing your project.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | GitHub / Source Code
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'github') ||
            str_contains($message, 'source code') ||
            str_contains($message, 'source-code') ||
            str_contains($message, 'code repository') ||
            str_contains($message, 'repository link')
        ) {
            return <<<TEXT
DevNext projects can include a GitHub/source-code link.

If a project has a GitHub URL, users can use the "View Source Code" or GitHub option on the project page to access the project's source repository.

A project does not have to display a GitHub button when no GitHub URL has been provided.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Live Demo
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'live demo') ||
            str_contains($message, 'demo link') ||
            str_contains($message, 'website demo') ||
            str_contains($message, 'project demo')
        ) {
            return <<<TEXT
Projects can include a Live Demo link.

A Live Demo is useful when you want users to try or preview your project online.

The Live Demo is separate from the project's video.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Project Video
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'project video') ||
            str_contains($message, 'project videos') ||
            str_contains($message, 'add a video') ||
            str_contains($message, 'project tutorial video')
        ) {
            return <<<TEXT
A project can include a separate Project Video.

The video can help demonstrate how the project works, show the interface, or explain the project.

The Project Video is separate from the Live Demo link.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Project Resources
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'project resources') ||
            str_contains($message, 'project resource') ||
            str_contains($message, 'upload resources') ||
            str_contains($message, 'upload resource') ||
            str_contains($message, 'project files') ||
            str_contains($message, 'download project files') ||
            str_contains($message, 'share project files')
        ) {
            return <<<TEXT
Project Resources are files that a developer can provide alongside a project.

They can be useful for:

• Supporting the project
• Providing source files
• Providing examples
• Sharing related materials
• Helping other developers understand the project

Depending on the project's access rules, users can view or download available resources.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Project Guide / Instructions
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'project guide') ||
            str_contains($message, 'project instructions') ||
            str_contains($message, 'project steps') ||
            str_contains($message, 'step by step') ||
            str_contains($message, 'how does the project guide work') ||
            str_contains($message, 'add instructions') ||
            str_contains($message, 'add a guide')
        ) {
            return <<<TEXT
Projects can include a Project Guide with step-by-step instructions.

A guide is useful for explaining:

• How the project works
• How to set it up
• How to use it
• Important steps
• Supporting information

Project creators can add individual steps and supporting images when needed.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Developer Profile
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'developer profile') ||
            str_contains($message, 'my profile') ||
            str_contains($message, 'profile page') ||
            str_contains($message, 'profile features') ||
            str_contains($message, 'what can i put on my profile')
        ) {
            return <<<TEXT
Your DevNext developer profile is your public developer identity.

You can customize it with:

• Profile picture
• Username
• Professional headline
• Bio
• Skills
• GitHub link
• Personal website

Your published projects can also be showcased on your profile.

Other users can discover your profile and, when signed in, follow you.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Edit Profile
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'edit my profile') ||
            str_contains($message, 'edit profile') ||
            str_contains($message, 'change my profile') ||
            str_contains($message, 'update my profile') ||
            str_contains($message, 'customize my profile')
        ) {
            return <<<TEXT
You can edit your developer profile from your profile/account area.

You can update information such as:

• Profile picture
• Username
• Headline
• Bio
• Skills
• GitHub
• Personal website

Your profile changes can be saved and reflected on your developer profile.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Skills
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'add skills') ||
            str_contains($message, 'my skills') ||
            str_contains($message, 'profile skills') ||
            str_contains($message, 'developer skills')
        ) {
            return <<<TEXT
You can add your development skills to your DevNext profile.

Skills help other users quickly understand the technologies or areas you work with.

Examples could include:

• PHP
• Laravel
• JavaScript
• HTML
• CSS
• C++
• Java
• MySQL

You can customize the skills shown on your own profile.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | GitHub Profile
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'add github to profile') ||
            str_contains($message, 'github profile') ||
            str_contains($message, 'github on my profile')
        ) {
            return <<<TEXT
You can add your GitHub profile link to your developer profile.

This gives visitors a convenient way to find your GitHub account and explore your public repositories.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Developer Discovery
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'find developers') ||
            str_contains($message, 'discover developers') ||
            str_contains($message, 'search developers') ||
            str_contains($message, 'where can i find developers') ||
            str_contains($message, 'look for developers') ||
            str_contains($message, 'find other developers')
        ) {
            return <<<TEXT
You can discover developers through the "Developers" section of DevNext.

You can search for developers using profile information such as:

• Username
• Headline
• Bio

Each developer card can provide useful information such as their profile, skills, followers, and projects.

You can open a developer's profile to learn more about them.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Search Developers
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'how do i search developers') ||
            str_contains($message, 'how to search developers') ||
            str_contains($message, 'search for a developer') ||
            str_contains($message, 'search a developer')
        ) {
            return <<<TEXT
Open the "Developers" section and use the search field.

You can search using information from a developer's:

• Username
• Headline
• Bio

The results can help you find developers whose work or skills interest you.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Follow Developers
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'how do i follow') ||
            str_contains($message, 'how to follow') ||
            str_contains($message, 'follow a developer') ||
            str_contains($message, 'follow someone') ||
            str_contains($message, 'follow developers') ||
            str_contains($message, 'can i follow')
        ) {
            return <<<TEXT
Yes. You can follow other developers on DevNext.

To follow someone:

1. Open their developer profile.
2. Find the Follow button.
3. Click Follow.

After following them, you can see that you are following them, and the developer receives a notification about the new follower.

You cannot follow your own account.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Unfollow
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'unfollow') ||
            str_contains($message, 'stop following') ||
            str_contains($message, 'remove a follow')
        ) {
            return <<<TEXT
You can unfollow a developer from their profile.

If you are currently following them, the button changes to the following state. Clicking it again allows you to stop following them.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Followers
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'followers') ||
            str_contains($message, 'who follows me') ||
            str_contains($message, 'see my followers') ||
            str_contains($message, 'follower list')
        ) {
            return <<<TEXT
Your developer profile shows your follower count.

You can open the Followers section to see the users who follow that developer.

Follower information is also available from public developer profiles.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Following
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'following list') ||
            str_contains($message, 'who am i following') ||
            str_contains($message, 'see who i follow') ||
            str_contains($message, 'developers i follow')
        ) {
            return <<<TEXT
DevNext provides a Following section on developer profiles.

It lets you see which developers an account is following.

You can also open developer profiles to explore their projects and information.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Likes
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'like a project') ||
            str_contains($message, 'like projects') ||
            str_contains($message, 'project likes') ||
            str_contains($message, 'how do i like') ||
            str_contains($message, 'how to like')
        ) {
            return <<<TEXT
You can like projects you find interesting.

When you like a project, the project receives a like from your account.

The like action is designed to let the community show interest in projects.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Saved Projects
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'saved projects') ||
            str_contains($message, 'save a project') ||
            str_contains($message, 'save projects') ||
            str_contains($message, 'how do i save') ||
            str_contains($message, 'how to save') ||
            str_contains($message, 'bookmark a project') ||
            str_contains($message, 'bookmarked projects')
        ) {
            return <<<TEXT
You can save projects that you want to keep for later.

Saving a project makes it available in your "Saved Projects" section.

This is useful when you find a project you are interested in but want to return to it later.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'how do notifications work') ||
            str_contains($message, 'notifications') ||
            str_contains($message, 'notification system') ||
            str_contains($message, 'what are notifications') ||
            str_contains($message, 'where are my notifications')
        ) {
            return <<<TEXT
DevNext has a notification system for account activity.

For example, when another developer follows you, you can receive a notification telling you who started following you.

The notification center can show recent notifications and unread notifications.

When you visit the Notifications page, unread notifications are marked as read.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Notification Badge
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'notification badge') ||
            str_contains($message, 'red notification') ||
            str_contains($message, 'unread notifications') ||
            str_contains($message, 'notification number')
        ) {
            return <<<TEXT
The notification badge indicates that you have unread notifications.

When you open the Notifications page, your unread notifications are marked as read, so the unread count can disappear.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Premium Projects
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'premium project') ||
            str_contains($message, 'premium projects') ||
            str_contains($message, 'what is premium') ||
            str_contains($message, 'what are premium projects') ||
            str_contains($message, 'premium access')
        ) {
            return <<<TEXT
DevNext supports premium projects.

A project creator can mark a project as premium.

Premium projects can require an active subscription before their protected content can be accessed.

Free projects remain available without the premium subscription requirement.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Subscription
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'subscription') ||
            str_contains($message, 'subscribe') ||
            str_contains($message, 'how do i subscribe') ||
            str_contains($message, 'monthly plan') ||
            str_contains($message, 'premium subscription')
        ) {
            return <<<TEXT
DevNext has a subscription system for premium project access.

The current subscription plan is:

⭐ ₱99/month

An active subscription can provide access to premium project content.

Your Dashboard can show your subscription status, start date, expiration date, and remaining access information.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Admin Access
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'admin access') ||
            str_contains($message, 'administrator') ||
            str_contains($message, 'admin account') ||
            str_contains($message, 'does admin need subscription')
        ) {
            return <<<TEXT
DevNext administrators have permanent access.

Administrators do not need a subscription expiration date because their access is permanent.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'dashboard') ||
            str_contains($message, 'what is on my dashboard') ||
            str_contains($message, 'account dashboard')
        ) {
            return <<<TEXT
Your DevNext Dashboard is your account management area.

Depending on your account, it can provide access to:

• Account information
• Profile management
• Password management
• Subscription information
• My Projects
• Project management
• Saved Projects
• Other account-related features

Administrators have additional administration features.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | My Projects
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'my projects') ||
            str_contains($message, 'where are my projects') ||
            str_contains($message, 'manage my projects') ||
            str_contains($message, 'project management')
        ) {
            return <<<TEXT
"My Projects" is the area where developers manage projects they created.

You can use it to:

• Create projects
• Edit projects
• Manage project information
• Upload project images
• Add links
• Publish or unpublish projects
• Manage project resources
• Manage project guides

It is the main workspace for your own DevNext projects.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Password / Account
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'change my password') ||
            str_contains($message, 'update my password') ||
            str_contains($message, 'forgot my password') ||
            str_contains($message, 'reset my password')
        ) {
            return <<<TEXT
DevNext provides account password management.

If you are signed in, you can update your password from your account settings.

If you forget your password, you can use the password reset option from the authentication system.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Programming - PHP
        |--------------------------------------------------------------------------
        */

        if (str_contains($message, 'php')) {
            return <<<TEXT
PHP is a server-side programming language commonly used to build dynamic websites and web applications.

Example:

\$name = "Ariel";
echo "Hello, \$name!";

DevNext uses PHP and Laravel for its backend application.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Programming - Laravel
        |--------------------------------------------------------------------------
        */

        if (str_contains($message, 'laravel')) {
            return <<<TEXT
Laravel is a PHP framework for building modern web applications.

Important Laravel concepts include:

• Routes
• Controllers
• Models
• Migrations
• Blade
• Middleware
• Authentication
• Eloquent ORM
• Services

DevNext is built with Laravel.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | JavaScript
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'javascript') ||
            preg_match('/\bjs\b/', $message)
        ) {
            return <<<TEXT
JavaScript is used to make webpages interactive.

It can handle things such as:

• Buttons
• Forms
• Menus
• AJAX requests
• Dynamic content
• Animations
• Browser interactions

Example:

const name = "Ariel";
console.log("Hello " + name);
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | HTML
        |--------------------------------------------------------------------------
        */

        if (str_contains($message, 'html')) {
            return <<<TEXT
HTML is the markup language used to structure webpages.

It defines elements such as:

• Headings
• Paragraphs
• Images
• Links
• Buttons
• Forms
• Sections

Example:

<h1>Hello DevNext!</h1>
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | CSS
        |--------------------------------------------------------------------------
        */

        if (
            preg_match('/\bcss\b/', $message) ||
            str_contains($message, 'cascading style sheets')
        ) {
            return <<<TEXT
CSS is used to style webpages.

It controls things such as:

• Colors
• Fonts
• Spacing
• Layout
• Borders
• Shadows
• Animations
• Responsive design

Example:

.card {
    padding: 20px;
    border-radius: 12px;
}
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | C++
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'c++') ||
            str_contains($message, 'cpp')
        ) {
            return <<<TEXT
C++ is a general-purpose programming language commonly used for software development, systems programming, and performance-sensitive applications.

Some important C++ concepts include:

• Variables
• Functions
• Conditions
• Loops
• Arrays
• Vectors
• Classes
• Objects
• Pointers
• Data structures
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Java
        |--------------------------------------------------------------------------
        */

        if (
            preg_match('/\bjava\b/', $message)
        ) {
            return <<<TEXT
Java is an object-oriented programming language used for many types of applications.

Important Java concepts include:

• Variables
• Conditions
• Loops
• Arrays
• Methods
• Classes
• Objects
• Constructors
• Inheritance
• Encapsulation
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Help / Capabilities
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($message, 'what can you do') ||
            str_contains($message, 'what can you help') ||
            str_contains($message, 'how can you help') ||
            str_contains($message, 'help me')
        ) {
            return <<<TEXT
I'm DevNext AI, your assistant for the DevNext platform.

I can help you with:

🏠 DevNext
• Understanding the platform
• Finding features
• Learning how different sections work

👤 Developers
• Developer profiles
• Developer discovery
• Followers and following

💻 Projects
• Creating projects
• Publishing projects
• Project images
• GitHub/source code
• Live demos
• Project videos
• Resources
• Project guides

❤️ Community
• Likes
• Saved projects
• Following
• Notifications

⭐ Premium
• Premium projects
• Subscriptions
• Access information

💻 Programming
• HTML
• CSS
• JavaScript
• PHP
• Laravel
• C++
• Java

Ask me a question and I'll do my best to help.
TEXT;
        }

        /*
        |--------------------------------------------------------------------------
        | Generic Fallback
        |--------------------------------------------------------------------------
        */

        return <<<TEXT
I'm DevNext AI, the assistant for the DevNext platform.

I can answer questions about the website, its features, the STA Coding Team, and basic programming.

Try asking:

• "Who are the developers here?"
• "What does STA stand for?"
• "How can I contact the developers?"
• "How do I add a project?"
• "How do I publish my project?"
• "How do project resources work?"
• "What is a project guide?"
• "How do I follow a developer?"
• "Where can I find developers?"
• "How do I save a project?"
• "How do notifications work?"
• "What are premium projects?"
• "What can I put on my profile?"
• "What is DevNext?"

I'm also able to help with programming topics such as HTML, CSS, JavaScript, PHP, Laravel, C++, and Java.
TEXT;
    }
}
