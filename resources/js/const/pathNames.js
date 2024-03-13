export default class PathNames {
    static HOME = '/';
    static TAVERN = '/tavern';

    
    static basePath = () => `\/${window.location.pathname.split(/[\/#?]/)[1]}`;
    static subdirectories = () => window.location.pathname.split(/[\/#?]/).slice(2);
}