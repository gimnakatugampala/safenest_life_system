import { createBrowserRouter } from 'react-router-dom';

// project imports
import MainRoutes from './MainRoutes';
import LoginRoutes from './LoginRoutes';
import ProfileRoutes from './ProfileRoutes';

// ==============================|| ROUTING RENDER ||============================== //

const router = createBrowserRouter([MainRoutes, LoginRoutes, ProfileRoutes], { basename: import.meta.env.VITE_APP_BASE_NAME });

export default router;
