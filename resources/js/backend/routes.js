
// Auth 
import LoginComponent from '@/components/auth/LoginComponent.vue';
import LogoutComponent from '@/components/auth/LogoutComponent.vue';

// Page
import PageComponent from '@/layout/Page.vue';

// Home - News
import HomeNewsIndex from '@/components/home/news/Index.vue';
import HomeNewsCreate from '@/components/home/news/Create.vue';
import HomeNewsEdit from '@/components/home/news/Edit.vue';
import HomeGridIndex from '@/components/home/grid/Index.vue';

// Discourse
import DiscourseIndex from '@/components/discourses/Index.vue';
import DiscourseCreate from '@/components/discourses/Create.vue';
import DiscourseEdit from '@/components/discourses/Edit.vue';

// Team
import TeamIndex from '@/components/team/team/Index.vue';
import TeamCreate from '@/components/team/team/Create.vue';
import TeamEdit from '@/components/team/team/Edit.vue';
import TeamImagesIndex from '@/components/team/images/Index.vue';

// Jobs
import JobIndex from '@/components/jobs/Index.vue';
import JobCreate from '@/components/jobs/Create.vue';
import JobEdit from '@/components/jobs/Edit.vue';

// Profile
import ProfileIndex from '@/components/profile/text/Index.vue';
import ProfileCreate from '@/components/profile/text/Create.vue';
import ProfileEdit from '@/components/profile/text/Edit.vue';
import ProfileImagesIndex from '@/components/profile/images/Index.vue';

// Contact
import ContactIndex from '@/components/contact/Index.vue';
import ContactCreate from '@/components/contact/Create.vue';
import ContactEdit from '@/components/contact/Edit.vue';

// Projects
import ProjectIndex from '@/components/projects/Index.vue';
import ProjectCreate from '@/components/projects/Create.vue';
import ProjectEdit from '@/components/projects/Edit.vue';
import ProjectGrid from '@/components/projects/grid/Index.vue';

import ProjectProgramIndex from '@/components/projects/program/Index.vue';
import ProjectProgramCreate from '@/components/projects/program/Create.vue';
import ProjectProgramEdit from '@/components/projects/program/Edit.vue';

import ProjectTextIndex from '@/components/projects/text/Index.vue';
import ProjectTextCreate from '@/components/projects/text/Create.vue';
import ProjectTextEdit from '@/components/projects/text/Edit.vue';

// Project - Intro S&E 
import ProjectIntroIndex from '@/components/projects/intro/Index.vue';
import ProjectIntroCreate from '@/components/projects/intro/Create.vue';
import ProjectIntroEdit from '@/components/projects/intro/Edit.vue';

// Interaction - Projects
import InteractionProjectIndex from '@/components/interactions/projects/Index.vue';
import InteractionProjectCreate from '@/components/interactions/projects/Create.vue';
import InteractionProjectEdit from '@/components/interactions/projects/Edit.vue';

// Interaction - Intro
import InteractionIntroIndex from '@/components/interactions/intro/Index.vue';
import InteractionIntroCreate from '@/components/interactions/intro/Create.vue';
import InteractionIntroEdit from '@/components/interactions/intro/Edit.vue';


// Strategy - Projects
import StrategyProjectIndex from '@/components/strategy/projects/Index.vue';
import StrategyProjectCreate from '@/components/strategy/projects/Create.vue';
import StrategyProjectEdit from '@/components/strategy/projects/Edit.vue';

// Strategy - Intro
import StrategyIntroIndex from '@/components/strategy/intro/Index.vue';
import StrategyIntroCreate from '@/components/strategy/intro/Create.vue';
import StrategyIntroEdit from '@/components/strategy/intro/Edit.vue';

const routes = [
  {
    path: '/',
    redirect: { name: 'login' }
  },
  {
    path: '/admin',
    name: 'admin',
    component: PageComponent,
    meta: { requiresAuth: true },
  },
  {
    path: '/admin/dashboard',
    name: 'dashboard',
    component: PageComponent,
    meta: { requiresAuth: true },
  },
  {
    path: '/admin/login',
    name: 'login',
    component: LoginComponent
  },
  {
    path: '/admin/logout',
    name: 'logout',
    component: LogoutComponent
  },

  // Home - News
  {
    name: 'home-news',
    path: '/admin/home/news',
    component: HomeNewsIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'home-news-create',
    path: '/admin/home/news/create',
    component: HomeNewsCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'home-news-edit',
    path: '/admin/home/news/edit/:id',
    component: HomeNewsEdit,
    meta: { requiresAuth: true },
  },

  // Home - Grids
  {
    name: 'home-grids',
    path: '/admin/home/grids',
    component: HomeGridIndex,
    meta: { requiresAuth: true },
  },

  // Projects
  {
    name: 'projects',
    path: '/admin/projects',
    component: ProjectIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-create',
    path: '/admin/project/create',
    component: ProjectCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-edit',
    path: '/admin/project/edit/:id',
    component: ProjectEdit,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-grids',
    path: '/admin/project/grid/:id',
    component: ProjectGrid,
    meta: { requiresAuth: true },
  },

  // Project - Program
  {
    name: 'project-program',
    path: '/admin/project/program',
    component: ProjectProgramIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-program-create',
    path: '/admin/project/program/create',
    component: ProjectProgramCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-program-edit',
    path: '/admin/project/program/edit/:id',
    component: ProjectProgramEdit,
    meta: { requiresAuth: true },
  },

  // Project - Text
  {
    name: 'project-text',
    path: '/admin/project/text/:id',
    component: ProjectTextIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-text-create',
    path: '/admin/project/text/create/:id',
    component: ProjectTextCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-text-edit',
    path: '/admin/project/text/edit/:id',
    component: ProjectTextEdit,
    meta: { requiresAuth: true },
  },

  // Project - Intro S&E
  {
    name: 'project-intro',
    path: '/admin/project-intro',
    component: ProjectIntroIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-intro-create',
    path: '/admin/project-intro/create',
    component: ProjectIntroCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'project-intro-edit',
    path: '/admin/project-intro/edit/:id',
    component: ProjectIntroEdit,
    meta: { requiresAuth: true },
  },

  
  // Discourse
  {
    name: 'discourses',
    path: '/admin/discourses',
    component: DiscourseIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'discourse-create',
    path: '/admin/discourse/create',
    component: DiscourseCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'discourse-edit',
    path: '/admin/discourse/edit/:id',
    component: DiscourseEdit,
    meta: { requiresAuth: true },
  },

  // Team
  {
    name: 'team',
    path: '/admin/team',
    component: TeamIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'team-create',
    path: '/admin/team/create',
    component: TeamCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'team-edit',
    path: '/admin/team/edit/:id',
    component: TeamEdit,
    meta: { requiresAuth: true },
  },

  // Team - Images
  {
    name: 'team-images',
    path: '/admin/team/images',
    component: TeamImagesIndex,
    meta: { requiresAuth: true },
  },
 
  // Job
  {
    name: 'jobs',
    path: '/admin/job',
    component: JobIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'job-create',
    path: '/admin/job/create',
    component: JobCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'job-edit',
    path: '/admin/job/edit/:id',
    component: JobEdit,
    meta: { requiresAuth: true },
  },

  // Profile
  {
    name: 'profile',
    path: '/admin/profile',
    component: ProfileIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'profile-create',
    path: '/admin/profile/create',
    component: ProfileCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'profile-edit',
    path: '/admin/profile/edit/:id',
    component: ProfileEdit,
    meta: { requiresAuth: true },
  },

  // Profile - Images
  {
    name: 'profile-images',
    path: '/admin/profile/images',
    component: ProfileImagesIndex,
    meta: { requiresAuth: true },
  },

  // InteractionProject
  {
    name: 'interaction-projects',
    path: '/admin/interaction/projects',
    component: InteractionProjectIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'interaction-project-create',
    path: '/admin/interaction/project/create',
    component: InteractionProjectCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'interaction-project-edit',
    path: '/admin/interaction/project/edit/:id',
    component: InteractionProjectEdit,
    meta: { requiresAuth: true },
  },
  {
    name: 'interaction-intro',
    path: '/admin/interaction/intro',
    component: InteractionIntroIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'interaction-intro-create',
    path: '/admin/interaction/intro/create',
    component: InteractionIntroCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'interaction-intro-edit',
    path: '/admin/interaction/intro/edit/:id',
    component: InteractionIntroEdit,
    meta: { requiresAuth: true },
  },

  // StrategyProject
  {
    name: 'strategy-projects',
    path: '/admin/strategy/projects',
    component: StrategyProjectIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'strategy-project-create',
    path: '/admin/strategy/project/create',
    component: StrategyProjectCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'strategy-project-edit',
    path: '/admin/strategy/project/edit/:id',
    component: StrategyProjectEdit,
    meta: { requiresAuth: true },
  },
  {
    name: 'strategy-intro',
    path: '/admin/strategy/intro',
    component: StrategyIntroIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'strategy-intro-create',
    path: '/admin/strategy/intro/create',
    component: StrategyIntroCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'strategy-intro-edit',
    path: '/admin/strategy/intro/edit/:id',
    component: StrategyIntroEdit,
    meta: { requiresAuth: true },
  },

  // Contact
  {
    name: 'contact',
    path: '/admin/contact',
    component: ContactIndex,
    meta: { requiresAuth: true },
  },
  {
    name: 'contact-create',
    path: '/admin/contact/create',
    component: ContactCreate,
    meta: { requiresAuth: true },
  },
  {
    name: 'contact-edit',
    path: '/admin/contact/edit/:id',
    component: ContactEdit,
    meta: { requiresAuth: true },
  },
];

export default routes