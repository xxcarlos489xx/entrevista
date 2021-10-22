import TipoCambioApi from './modulos/TipoCambioApi';

const SERVICES = {
    TipoCambio: TipoCambioApi,
}

export const ApiFactory = {
    get: (name) => SERVICES[name],
};