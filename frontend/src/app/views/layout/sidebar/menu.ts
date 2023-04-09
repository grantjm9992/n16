import { MenuItem } from './menu.model';

export const MENU: MenuItem[] = [
  {
    label: 'Main',
    isTitle: true
  },
  {
    label: 'Dashboard',
    icon: 'home',
    link: '/dashboard'
  },
  {
    label: 'Web Apps',
    isTitle: true
  },
  {
    label: 'Calendar',
    icon: 'calendar',
    link: '/calendar',
    badge: {
      variant: 'primary',
      text: 'By classroom',
    }
  },
  {
    label: 'Calendar',
    icon: 'calendar',
    link: '/calendar-by-teacher',
    badge: {
      variant: 'primary',
      text: 'By teacher',
    }
  },
  {
    label: 'Admin',
    isTitle: true
  },
  {
    label: 'Users',
    icon: 'user',
    link: '/user',
  },
  {
    label: 'Teachers',
    icon: 'user',
    link: '/teacher',
  },
  {
    label: 'Companies',
    icon: 'briefcase',
    link: '/company',
  },
  {
    label: 'Event Types',
    icon: 'user',
    link: '/event-type',
  },
  {
    label: 'Events',
    icon: 'user',
    link: '/event',
  },
  {
    label: 'Departments',
    icon: 'user',
    link: '/department',
  },
  {
    label: 'Classrooms',
    icon: 'user',
    link: '/classroom',
  },
];
