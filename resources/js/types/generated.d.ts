export type CivilizationData = {
    id: number;
    name: string;
    icon: string;
    dawnOfMan: string;
    historicalInfo: Array<{ text: string; heading: string }>;
    leader: LeaderData | null;
};
export type LeaderData = {
    id: number;
    civilizationId: number | null;
    name: string;
    subtitle: string;
    lived: string;
    icon: string;
    trait: { name: string; effect: string };
    titles: Array<string>;
    historicalInfo: Array<{ text: string; heading: string }>;
    civilization: CivilizationData | null;
};
