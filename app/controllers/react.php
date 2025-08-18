<?php

class React extends TinyController
{
    public function get($request, $response)
    {
        switch (tiny::router()->uri) {
            case '/react':
                $response->renderReact(
                    component: 'Home',
                    props: [
                        'title' => 'Welcome to PHP with React',
                        'message' => 'This is the home page rendered with React!',
                    ],
                    meta: [
                        'title' => 'Welcome to PHP with React',
                        'description' => 'This is the home page rendered with React!',
                        'og_image' => 'https://example.com/images/team-photo.jpg',
                        'twitter_card' => 'summary_large_image'
                    ]
                );
                break;
                case '/react/about':
                    $response->renderReact(
                        component: 'About',
                        props: [
                            'title' => 'About Us',
                            'content' => 'This is the about page. We are using PHP to create a modern single-page application experience with PHP and React.',
                            'team' => [
                                ['name' => 'John Doe', 'role' => 'Developer'],
                                ['name' => 'Jane Smith', 'role' => 'Designer'],
                                ['name' => 'Bob Johnson', 'role' => 'Project Manager']
                            ]
                        ],
                        meta: [
                            'title' => 'About Us - PHP React SPA Demo',
                            'description' => 'Learn about our team and how we built this modern SPA with PHP and React',
                            'og_image' => 'https://example.com/images/team-photo.jpg',
                            'twitter_card' => 'summary_large_image'
                        ]
                    );
                    break;
                case '/react/about/team':
                    $response->renderReact(
                        component: 'About/Team',
                        props: [
                            'title' => 'Our Team',
                            'description' => 'Meet the talented people behind our project.',
                            'teamMembers' => [
                                [
                                    'id' => 1,
                                    'name' => 'John Doe',
                                    'role' => 'Lead Developer',
                                    'bio' => 'Passionate about creating elegant solutions to complex problems.',
                                    'image' => 'https://via.placeholder.com/150',
                                    'social' => [
                                        'github' => 'https://github.com',
                                        'linkedin' => 'https://linkedin.com'
                                    ]
                                ],
                                [
                                    'id' => 2,
                                    'name' => 'Jane Smith',
                                    'role' => 'UI/UX Designer',
                                    'bio' => 'Creating beautiful and intuitive user experiences.',
                                    'image' => 'https://via.placeholder.com/150',
                                    'social' => [
                                        'dribbble' => 'https://dribbble.com',
                                        'twitter' => 'https://twitter.com'
                                    ]
                                ],
                                [
                                    'id' => 3,
                                    'name' => 'Bob Johnson',
                                    'role' => 'Project Manager',
                                    'bio' => 'Keeping everything running smoothly and on schedule.',
                                    'image' => 'https://via.placeholder.com/150',
                                    'social' => [
                                        'linkedin' => 'https://linkedin.com'
                                    ]
                                ]
                            ]
                        ],
                        meta: [
                            'title' => 'Our Team - PHP React SPA Demo',
                            'description' => 'Learn about our team and how we built this modern SPA with PHP and React',
                            'og_image' => 'https://example.com/images/team-photo.jpg',
                            'twitter_card' => 'summary_large_image'
                        ]
                    );
                    break;
            case '/react/contact':
                $response->renderReact(
                    component: 'Contact',
                    props: [
                        'title' => 'Contact Us',
                        'email' => 'contact@example.com',
                        'phone' => '+1 (555) 123-4567'
                    ],
                    meta: [
                        'title' => 'Contact Us - PHP React SPA Demo',
                        'description' => 'Contact us for any questions or feedback',
                        'og_image' => 'https://example.com/images/team-photo.jpg',
                        'twitter_card' => 'summary_large_image'
                    ]
                );
                break;
        }
    }
}
